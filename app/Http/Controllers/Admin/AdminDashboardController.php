<?php

namespace App\Http\Controllers\Admin;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $buku       = Buku::count();
        $anggota    = User::where('roles', 'ANGGOTA')->count();
        $petugas    = User::where('roles', 'PETUGAS')->count();
        $peminjaman = Buku::where('status', 'DIPINJAM')->count();
        
        return view('pages.admin.index', [
            'buku'          => $buku,
            'anggota'       => $anggota,
            'petugas'       => $petugas,
            'peminjaman'    => $peminjaman,
        ]);
    }
}
