@extends('layouts.app')

@section('title')
    Peminjaman - Perpustakaan
@endsection

@section('content')
    <div class="content" style="margin-top: 60px;">
        <div class="row">
            <div class="container-fluid">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-dark">
                            <tr>
                                <td>No</td>
                                <td>Nama Buku</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($peminjaman as $pinjam)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pinjam->buku->name }}</td>                                   
                                    @if ($pinjam->status == 'MENUNGGU')
                                        <td class="text-danger">{{ $pinjam->status }}</td>
                                    @else
                                        <td class="text-success">{{ $pinjam->status }}</td>
                                    @endif
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum Pernah Meminjam Buku.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $peminjaman->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection