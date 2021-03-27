<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['provinsi', 'nama_peternakan','author', 'jenis_peternakan','alamat', 'lat', 'lng'];
    protected $table = 'location';
}
