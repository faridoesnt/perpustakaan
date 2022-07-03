<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $guarded = ['id'];

    public function pinjam()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id', 'id');
    }

    public function kembali()
    {
        return $this->hasMany(Pengembalian::class, 'buku_id', 'id');
    }
}
