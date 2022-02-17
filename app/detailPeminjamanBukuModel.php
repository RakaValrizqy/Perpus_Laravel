<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detailPeminjamanBukuModel extends Model
{
    protected $table = 'detail_peminjaman_buku';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_peminjaman_buku','id_buku','qty'
    ];
}
