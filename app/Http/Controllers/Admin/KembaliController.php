<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class KembaliController extends Controller
{
    public function index()
    {
        $kembali = Pengembalian::with(['buku', 'user'])->paginate(10);

        return view('pages.admin.pengembalian.index', [
            'kembali'    => $kembali,
        ]);
    }
}
