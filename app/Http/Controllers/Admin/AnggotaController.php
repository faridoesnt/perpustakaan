<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggota = User::where('roles', 'ANGGOTA')->paginate(10);

        $data['anggota'] = $anggota;

        $view = 'pages.admin.anggota.index';

        return view($view, $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.anggota.create');
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
            'name'          => 'required',
            'email'         => 'required|unique:users',
            'password'      => 'required',
            'roles'         => 'required',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'roles'     => $request->roles,
        ]);

        return redirect()->route('anggota.index')->with('sukses', 'Sukses Menambah Anggota');
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
        $anggota = User::findOrfail($id);

        return view('pages.admin.anggota.edit', [
            'anggota'     => $anggota,
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
        $user_exists = User::where('id', $id)->where('email', $request->email)->exists();
        $user_exists2 = User::where('email', $request->email)->exists();

        if($user_exists)
        {
            $update_user = User::where('id', $id)->update([
                'name' => $request->name,
            ]);
        }
        elseif($user_exists2)
        {
            return redirect()->back()->with('warning', 'Email Tidak Boleh Sama.');
        }
        else
        {
            $update_user = User::where('id', $id)->update([
                'name'     => $request->name,
                'email'    => $request->email,
            ]);
        }

        // kembali ke route yang
        return redirect()->route('anggota.index')->with('sukses', 'Berhasil Mengupdate Anggota!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anggota = User::findOrfail($id);

        $anggota->delete();

        return redirect()->route('anggota.index')->with('sukses', 'Berhasil Menghapus!');
    }
}
