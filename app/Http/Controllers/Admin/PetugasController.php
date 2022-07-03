<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugas = User::where('roles', 'PETUGAS')->paginate(10);

        $data['petugas'] = $petugas;

        $view = 'pages.admin.petugas.index';

        return view($view, $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.petugas.create');
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

        return redirect()->route('petugas.index')->with('sukses', 'Sukses Menambah Petugas');
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
        $petugas = User::findOrfail($id);

        return view('pages.admin.petugas.edit', [
            'petugas'     => $petugas,
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
                'email' => $request->email,
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
        return redirect()->route('petugas.index')->with('sukses', 'Berhasil Mengupdate Petugas!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $petugas = User::findOrfail($id);

        $petugas->delete();

        return redirect()->route('petugas.index')->with('sukses', 'Berhasil Menghapus!');
    }
}
