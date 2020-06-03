<?php

namespace App\Repositories\Produto;

interface ProdutoRepositoryInterface
{
    public function getProdutos();
    public function getProduto(int $id);
    public function createProduto(array $dados);
    public function updateProduto(int $id,array $dados);
    public function deleteProduto(int $id);
}
