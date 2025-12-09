<?php

namespace App\Http\Controllers;

use App\Models\User;  // Menggunakan model User untuk akun
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function registerForm()
    {
        return view('auth.register');
    }

    public function registerProses(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Simpan user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin', // default role
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
    public function loginProses(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
        // ambil data dr input satukan pada array
        $user = $request->only('email', 'password');
        // cek kecocokan email dan password, lalu simpan pada class auth
        if (Auth::attempt($user)) {
            // attempt 1. Mengecek kecocokan email dan password
            // attempt 2. Memastikan enkripsi
            // attempt 3. Memasukan kedalam history
            // jika berhasil, redirect ke landing page
            return redirect()->route('landing_page')->with('success', 'Selamat datang ' . Auth::user()->name);
        } else {
            return redirect()->back()->with('failed', 'Password Atau Email salah');
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Log out behasil');
    }

    /**
     * Tampilkan daftar akun dengan opsi pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->input('cari');

        // Filter data akun berdasarkan pencarian
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(10); // Paginate

        return view('user.index', compact('users'));
    }

    /**
     * Tampilkan form untuk menambahkan akun.
     */
    public function create()
    {
        return view('user.create'); // Sesuaikan dengan view tambah akun
    }

    /**
     * Simpan data akun yang baru ditambahkan.
     */
    public function store(Request $request)
    {
        // Validasi data yang dimasukkan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'role' => 'required|in:admin', // Pastikan role sesuai
            'password' => 'required|min:6', // Validasi password
        ]);

        // Hash password dengan yang diinputkan pengguna
        $password = substr($request->name, 0, 3) . substr($request->email, 0, 3);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($password), // Hash password
        ]);

        return redirect()->route('kelola_akun.data')->with('success', 'Akun berhasil ditambahkan.');
    }

    /**
     * Tampilkan form untuk mengubah data akun.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // Cari akun berdasarkan ID
        return view('user.edit', compact('user')); // Sesuaikan dengan view edit akun
    }

    /**
     * Simpan perubahan data akun.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diperbarui
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin', // Pastikan role sesuai
            'password' => 'nullable|min:6', // Password opsional, jika ingin diubah
        ]);

        // Cari akun berdasarkan ID dan perbarui
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password')); // Hash password jika diisi
        }

        $user->save();

        return redirect()->route('kelola_akun.data')->with('success', 'Data akun berhasil diperbarui.');
    }

    /**
     * Hapus akun.
     * Hapus akun berdasarkan ID yang diberikan.
     *
     * @param int $id ID akun yang akan dihapus.
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman daftar akun dengan pesan sukses.
     * @throws \Exception Jika akun tidak ditemukan.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('kelola_akun.data')->with('success', 'Akun berhasil dihapus.');
    }

    public function landingPage()
    {
        return view('landing_page');
    }
}
