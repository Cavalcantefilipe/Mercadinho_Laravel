<?php

namespace App\Repositories\Venda;

use App\Models\Venda;
use App\Repositories\Venda\VendaRepositoryInterface;


class VendaRepositoryEloquent implements VendaRepositoryInterface
{
    private $venda;

    public function __construct(Venda $venda)
    {
        $this->venda = $venda;
    }


    public function getVendas()
    {
        $query = $this->venda->select();
        return $query->get();
    }

    public function getVenda(int $id)
    {
        return $this->venda->select()
            ->where('idVenda', $id)
            ->first();
    }

    public function createVenda(array $dados)
    {
        return $this->venda->create($dados);
    }

    public function updateVenda(int $id, array $dados)
    {
        return $this->venda
            ->where('idVenda', $id)
            ->update($dados);
    }

    public function deleteVenda(int $id)
    {
        $query = $this->Venda->find($id);
        return $query->delete();
    }
}
