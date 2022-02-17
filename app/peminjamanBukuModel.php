<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peminjamanBukuModel extends Model
{
    protected $table = 'peminjaman_buku';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_siswa','tanggal_pinjam','tanggal_kembali'
    ];
}
