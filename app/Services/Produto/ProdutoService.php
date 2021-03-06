<?php

namespace App\Services\Produto;

use Illuminate\Database\QueryException;
use App\Repositories\Produto\ProdutoRepositoryInterface as Produto;

class ProdutoService
{

    private $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function getProdutos($descricao = null)
    {
        try {
            return $this->produto->getProdutos($descricao);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getProduto(int $id)
    {
        try {
            return $this->produto->getProduto($id);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function createProduto(array $dados)
    {
        try {
            if (count($dados) > 0) {
                foreach ($dados as $dado) {
                    $this->produto->createProduto($dado);
                }
                return $dados;
            }
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function updateProduto(int $id, array $dados)
    {
        try {
            return $this->produto->updateProduto($id, $dados);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function deleteProduto(int $id)
    {
        try {
            return $this->produto->deleteProduto($id);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
