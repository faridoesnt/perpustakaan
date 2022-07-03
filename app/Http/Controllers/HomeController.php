<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $bukus = Buku::where('status', 'TERSEDIA')->get();


        return view('pages.home', [
            'bukus'  => $bukus
        ]);
    }

    public function peminjaman()
    {
        $peminjaman = Peminjaman::with('buku', 'user')->where('users_id', Auth::user()->id)->paginate(10);

        return view('pages.peminjaman', [
            'peminjaman'  => $peminjaman
        ]);
    }

    public function pinjam_buku($id)
    {
        $buku = Buku::findOrfail($id);

        Peminjaman::create([
            'buku_id'   => $buku->id,
            'users_id'  => Auth::user()->id,
            'status'    => 'MENUNGGU'
        ]);

        return redirect()->route('peminjaman-home');
    }
}
