<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    //
    protected $table = 'pemasok';
    protected $primaryKey = 'id_p';
    protected $fillable = ['nama_p', 'alamat', 'no_telpon'];

}
