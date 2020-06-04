<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'idCliente';


    protected $fillable = [
        'nome',
        'cpf/cnpj',
        'dataCadastrado'

    ];

    public $timestamps = false;


    protected $hidden = [];


    protected $casts = [];
}
