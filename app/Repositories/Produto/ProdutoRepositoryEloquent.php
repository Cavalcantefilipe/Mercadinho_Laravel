<?php

namespace App\Repositories\Produto;

use App\Models\Produto;
use App\Repositories\Produto\ProdutoRepositoryInterface;


class ProdutoRepositoryEloquent implements ProdutoRepositoryInterface
{
    private $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }


    public function getProdutos($descricao = null)
    {
        $query = $this->produto->select();
        if($descricao){
            $query->where('descricao',$descricao);
        }
        return $query->get();
    }

    public function getProduto(int $id)
    {
        return $this->produto->select()
            ->where('idProduto', $id)
            ->first();
    }

    public function createProduto(array $dados)
    {
        return $this->produto->create($dados);
    }

    public function updateProduto(int $id, array $dados)
    {
        return $this->produto
            ->where('idProduto', $id)
            ->update($dados);
    }

    public function deleteProduto(int $id)
    {
        $query = $this->produto->find($id);
        return $query->delete();
    }
}
