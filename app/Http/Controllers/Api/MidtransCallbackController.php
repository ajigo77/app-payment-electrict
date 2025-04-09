<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pemakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransCallbackController extends Controller
{
    public function handleNotificationMidtrans(Request $request)
    {
        try {
            // $notif = new \Midtrans\Notification();
            $notif = $request->all();
            $transaction_status = $notif['transaction_status'];
            $payment_type = $notif['payment_type'];
            $order_id = $notif['order_id'];
            $fraud_status = $notif['fraud_status'];
            $gross_amount = $notif['gross_amount'];
            $status_code = $notif['status_code'];
            $reqSignatureKey = $notif['signature_key'];
            $signature_key = hash('sha512', $order_id . $status_code . $gross_amount . config('midtrans.serverKey'));

            $pemakaian = Pemakaian::findOrFail($order_id);

            // Status
            $status_mapping = [
                'capture' => 'success',
                'settlement' => 'success',
                'pending' => 'pending',
                'deny' => 'failed',
                'expire' => 'expired',
                'cancel' => 'cancelled',
            ];

            // Jika status cancel, tidak akan membuat record pembayaran
            if ($transaction_status === 'cancel') {
                return response()->json(['status' => 'Canceled', 'message' => 'Pembayaran dibatalkan']);
            }

            // Jika signature key tidak valid, tidak akan membuat record pembayaran
            if ($reqSignatureKey !== $signature_key) {
                return response()->json(['status' => 'Invalid Signature Key', 'message' => 'Pembayaran tidak valid']);
            }

            // Mencari pembayaran berdasarkan pemakaian_id
            $pembayaran = Pembayaran::where('pemakaian_id', $order_id)->first();

            // Jika pembayaran ada, update 3 kolom pada tabel pembayarannya
            if ($pembayaran) {
                $pembayaran->update([
                    'no_ref' => $notif["transaction_id"],
                    'status' => $status_mapping[$transaction_status] ?? 'pending',
                    'tanggal_bayar' => $notif["transaction_time"],
                ]);
            }

            // Jika pembayaran nya berhasil, update status pemakaian dan pembayaran
            if (in_array($transaction_status, ['capture', 'settlement'])) {
                // Jika pembayaran dengan kredit yang tidak aman
                if ($payment_type === 'credit_card' && $fraud_status === 'challenge') {
                    $pembayaran->update(['status' => 'challenge']);
                    $pemakaian->update(['status' => 'gagal']);
                } else {
                    // Jika pembayaran berhasil dan aman
                    $pemakaian->update(['status' => 'lunas']);
                    $pembayaran->update([
                        'status' => 'success',
                    ]);
                }
            } elseif ($transaction_status === 'pending') {
                $pembayaran->update(['status' => 'pending']);
                $pemakaian->update(['status' => 'pending']);
            } elseif (in_array($transaction_status, ['deny', 'expire', 'cancel'])) {
                $pembayaran->update(['status' => $status_mapping[$transaction_status]]);
                $pemakaian->update(['status' => 'belum bayar']);
            }

            // Log::info('Midtrans Notification', [
            //     'status' => $transaction_status,
            //     'payment_type' => $payment_type,
            //     'order_id' => $order_id,
            //     'fraud_status' => $fraud_status,
            //     'status_code' => $status_code,
            // ]);

            return response()->json(['status' => 'OK']);

        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error: ' . $e->getMessage());
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ],
                500,
            );
        }
    }
}
