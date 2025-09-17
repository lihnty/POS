<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        confirmDelete('Hapus user', 'Apakah anda yakin menghapus user ini');
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
        ]);

        $newRequest = $request->all();
        if(!$id) {
            $newRequest['password'] = Hash::make('12345678');
        }

        User::updateOrCreate(['id' => $id], $newRequest);
        toast()->success('User berhasil disimpan');
        return redirect()->route('users.index');
    }

    public function gantiPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
            // 'password' => [Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
        ], [
            'old_password.required' => 'Password lama wajib diisi',
            'password.required' => 'Password baru wajib diisi',
            'password.min' => 'Password baru minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
        ]);

        $user = User::find(Auth::id());

        // cek apakah password lama sesuai
        if(!Hash::check($request->old_password, $user->password)) {
            toast()->error('Password lama tidak sesuai');
            return redirect()->route('dashboard');           
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        toast()->success('Password berhasil diubah');
        return redirect()->route('users.index');
    }

    public function destroy(String $id)
    {
        $user = User::find($id);
        if(Auth::id() == $id) {
            toast()->error('Tidak dapat menghapus akun yang sedang login');
            return redirect()->route('users.index');
        }

        $user->delete();
        toast()->success('User berhasil dihapus');
        return redirect()->route('users.index');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $user = User::find($request->id);
        $user->update([
            'password' => Hash::make('12345678')
        ]);

        toast()->success('Password berhasil direset ke 12345678');
        return redirect()->route('users.index');
    }
}
