<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangkeluar extends Model
{
    //
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_bk';
    protected $fillable = ['nama_bk', 'jumlah', 'keterangan', 'tgl_k'];
}
