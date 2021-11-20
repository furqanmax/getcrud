<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Savetable extends Model
{
    protected $table = 'savetables';
    public $timestamps = true;

    

    protected $fillable = [
        'tabel_name',
        'columns',
        'created_at'
    ];
}
