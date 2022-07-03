@extends('layouts.dashboard')

@section('title')
    Perpustakaan
@endsection

@section('content')
    <div class="content-wrapper">
        
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Peminjaman</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Peminjaman</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if (session('sukses'))
                    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                        {{ session('sukses') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    {{-- <div class="card-header">
                        <a href="{{ route('anggota.create') }}" class="btn btn-primary">Tambah Anggota Baru</a>
                    </div> --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Nama Buku</td>
                                        <td>Nama Peminjaman</td>
                                        <td>Tanggal Peminjaman</td>
                                        <td>Status</td>
                                        <td style="width: 20%;">Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pinjam as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->buku->name }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ date('j F Y', strtotime($item->created_at ?? '')) }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                @if ($item->status == 'MENUNGGU')
                                                    <div class="btn-group">
                                                        <form action="{{ route('terima-peminjaman', $item->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success">
                                                                TERIMA
                                                            </button>
                                                        </form>
                                                    </div>
                                                @elseif ($item->status == 'DIPINJAM')
                                                    <div class="btn-group">
                                                        <form action="{{ route('kembali-peminjaman', $item->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success">
                                                                KEMBALIKAN
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $pinjam->links() }}
                        </div>
                    </div>
                </div>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection