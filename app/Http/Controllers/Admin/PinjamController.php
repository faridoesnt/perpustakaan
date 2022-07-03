<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    public function index()
    {
        $pinjam = Peminjaman::with(['buku', 'user'])->paginate(10);

        return view('pages.admin.peminjaman.index', [
            'pinjam'    => $pinjam,
        ]);
    }

    public function terima_peminjaman($id)
    {
        $pinjam = Peminjaman::findOrfail($id);

        if($pinjam->status == 'MENUNGGU')
        {
            $update = Peminjaman::where('id', $id)->update(['status' => 'DIPINJAM']);
        }

        $update_buku = Buku::where('id', $pinjam->buku_id)->update(['status' => 'DIPINJAM']);

        return redirect()->route('peminjaman')->with('sukses', 'Buku Berhasil Dipinjam.');
    }

    public function kembali_peminjaman($id)
    {
        $kembali = Peminjaman::findOrfail($id);

        if($kembali->status == 'DIPINJAM')
        {
            $update = Peminjaman::where('id', $id)->update(['status' => 'SUDAH DIKEMBALIKAN']);

            Pengembalian::create([
                'buku_id'   => $kembali->buku_id,
                'users_id'  => $kembali->users_id,
                'status'    => 'SUDAH DIKEMBALIKAN',
            ]);

            $update = Buku::where('id', $kembali->buku_id)->update(['status' => 'TERSEDIA']);
        }

        return redirect()->route('peminjaman');
    }
}
