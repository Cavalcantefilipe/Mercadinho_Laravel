<?php

namespace App\Repositories\ItensVenda;

interface ItensVendaRepositoryInterface
{
    public function getItensVendas(int $idVenda,int $idProduto);
    public function getItensVenda(int $id);
    public function createItensVenda(array $dados);
    public function updateItensVenda(int $id,array $dados);
    public function deleteItensVenda(int $id);
}
