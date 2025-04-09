<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;

class HomeController extends Controller
{
    public function pelangganView(){

        $search = request()->search;
        $currentStatus = $search ?? 'semua';
        $query = Pemakaian::with(['pelanggan']);
        
        // Jika ada pencarian
        if($search){
            $query->where(function($q) use ($search){
                $searchTerm = '%' . $search . '%';
                $q->where('status', $searchTerm)
                ->orWhere('tahun', 'LIKE', $searchTerm)
                ->orWhere('bulan', 'LIKE', $searchTerm)
                  ->orWhereHas('pelanggan', function($query) use ($searchTerm){
                    $query->where('nama','LIKE', $searchTerm)
                    ->orWhere('alamat','LIKE', $searchTerm)
                    ->orWhere('no_kontrol','LIKE', $searchTerm)
                    ->orWhere('telpon','LIKE', $searchTerm);
                  });
            });
        }

        $data_pelanggan = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        if (request()->ajax()) {
            return view('client.components.search.searching', compact('data_pelanggan', 'currentStatus'))->render();
        }

        return view('client.home.pelanggan', compact('data_pelanggan', 'currentStatus'));
    }
}
