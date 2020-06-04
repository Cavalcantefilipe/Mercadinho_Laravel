<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = 'venda';
    protected $primaryKey = 'idVenda';


    protected $fillable = [
        'total',
        'idCliente',
        'finalizado'

    ];

    public $timestamps = false;


    protected $hidden = [];


    protected $casts = [];
}
