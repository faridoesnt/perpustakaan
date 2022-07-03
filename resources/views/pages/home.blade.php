@extends('layouts.app')

@section('title')
    Home - Perpustakaan
@endsection

@section('content')
    <div class="content" style="margin-top: 60px;">
        <div class="row">
            @foreach ($bukus as $buku)
                <div class="col-lg-4">
                    <div class="card shadow-md">
                        <div class="card-header text-center">
                            Judul: {{ $buku->name }}
                        </div>
                        <div class="card-body text-center text-success">
                            {{ $buku->status }}
                        </div>
                        <div class="card-footer">
                            @auth
                                <form action="{{ route('pinjam-buku', $buku->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <button type="submit" class="btn btn-secondary btn-block">Pinjam</button>
                                </form>
                            @endauth
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-secondary btn-block">Pinjam</a>
                            @endguest
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection