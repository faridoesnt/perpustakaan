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
                    <h1 class="m-0">Daftar Buku</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Buku</li>
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
                    @can('admin')
                        <div class="card-header">
                            <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku Baru</a>
                        </div>
                    @endcan
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Nama Buku</td>
                                        <td>Status</td>
                                        @can('admin')
                                            <td style="width: 20%;">Aksi</td>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($buku as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if ($item->status == 'TERSEDIA')
                                                    <div class="text-success">{{ $item->status }}</div>
                                                @else
                                                    <div class="text-danger">{{ $item->status }}</div>
                                                @endif    
                                            </td>
                                            @can('admin')
                                                <td>
                                                    <div class="row">
                                                        <a href="{{ route('buku.edit', $item->id) }}" class="btn btn-primary mr-2">Edit</a>
                                                        <form action="{{ route('buku.destroy', $item->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $buku->links() }}
                        </div>
                    </div>
                </div>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection