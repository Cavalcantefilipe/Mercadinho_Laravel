<?php

namespace App\Repositories\Venda;

interface VendaRepositoryInterface
{
    public function getVendas();
    public function getVenda(int $id);
    public function createVenda(array $dados);
    public function updateVenda(int $id,array $dados);
    public function deleteVenda(int $id);
}
