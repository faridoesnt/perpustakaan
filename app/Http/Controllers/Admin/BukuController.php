<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::paginate(10);

        $data['buku'] = $buku;

        $view = 'pages.admin.buku.index';

        return view($view, $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|unique:buku',
            'status'  => 'required'
        ]);

        Buku::create([
            'name'      => $request->name,
            'status'    => $request->status,
        ]);

        return redirect()->route('buku.index')->with('sukses', 'Sukses Menambah Buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::findOrfail($id);

        return view('pages.admin.buku.edit', [
            'buku'     => $buku,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $buku_exists = Buku::where('id', $id)->where('name', $request->name)->exists();
        $buku_exists2 = Buku::where('name', $request->name)->exists();

        if($buku_exists)
        {
            $update_buku = Buku::where('id', $id)->update([
                'status' => $request->status,
            ]);
        }
        elseif($buku_exists2)
        {
            return redirect()->back()->with('warning', 'Nama Buku Tidak Boleh Sama.');
        }
        else
        {
            $update_buku = Buku::where('id', $id)->update([
                'name'      => $request->name,
                'status'    => $request->status,
            ]);
        }

        return redirect()->route('buku.index')->with('sukses', 'Berhasil Mengupdate Buku!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::findOrfail($id);

        $buku->delete();

        return redirect()->route('buku.index')->with('sukses', 'Berhasil Menghapus!');
    }
}
