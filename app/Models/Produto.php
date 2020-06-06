<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produto';
    protected $primaryKey = 'idProduto';


    protected $fillable = [
        'descricao',
        'quantidade',
        'preco',
        'dataCadastrado'

    ];

    public $timestamps = false;


    protected $hidden = [];


    protected $casts = [];
}
