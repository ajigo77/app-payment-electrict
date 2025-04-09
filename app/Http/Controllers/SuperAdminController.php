<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class SuperAdminController extends Controller
{
    public function petugasView()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('dashboard.components.pages.petugas', [
            'title' => 'petugas',
            'users' => $users,
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate(
            [
                'nama_lengkap' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'role' => ['required', Rule::in(['admin', 'super_admin'])],
            ],
            [
                'nama_lengkap.required' => 'Tidak boleh kosong',
                'nama_lengkap.max' => 'Maksimal 255 karakter',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah digunakan',
                'password.required' => 'Password harus diisi',
                'role.required' => 'Role harus dipilih',
                'role.in' => 'Role yang dipilih tidak valid',
            ],
        );

        // Jika validasi lolos maka akan dibuat 1 record ke dalam tabel users
        $user = User::create([
            'nama_lengkap' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        if ($user) {
            return redirect()->route('dashboard.petugas')->with('success', 'Petugas berhasil ditambahkan');
        }

        return back()->withInput();
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate(
            [
                'nama_lengkap' => 'required|string|max:255',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id_user, 'id_user')],
                'password' => 'nullable|string',
                'role' => ['required', Rule::in(['admin', 'super_admin'])],
            ],
            [
                'nama_lengkap.required' => 'Nama lengkap harus diisi',
                'nama_lengkap.max' => 'Nama lengkap maksimal 255 karakter',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah digunakan',
                'password.min' => 'Password minimal 8 karakter',
                'role.required' => 'Role harus dipilih',
                'role.in' => 'Role yang dipilih tidak valid',
            ],
        );

        $updateData = [
            'nama_lengkap' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        if ($user) {
            return redirect()->route('dashboard.petugas')->with('success', 'Data petugas berhasil diperbarui');
        }

        return back()->withInput();
    }

    public function delete(User $user)
    {
        if (!$user) {
            return redirect()->route('dashboard.petugas')->with('error', 'User tidak dapat ditemukan');
        }

        if ($user->id_user === Auth::id()) {
            return redirect()->route('dashboard.petugas')->with('error', 'Anda tidak dapat menghapus akun sendiri');
        }

        if(Auth::check()){
            $role_user = Auth::user();
        }

        if ($role_user->role !== 'super_admin' && $user->role === 'super_admin') {
            return redirect()->route('dashboard.petugas')->with('error', 'Anda tidak memiliki izin untuk menghapus Super Admin');
        }

        $user->delete();

        return redirect()->route('dashboard.petugas')->with('success', 'Petugas berhasil dihapus');
    }
}
