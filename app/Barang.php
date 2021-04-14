<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $table = 'barang';
    protected $primaryKey = 'id_b';
    protected $fillable = ['nama_b', 'brand', 'pemasok', 'jumlah', 'tgl_m'];

}
