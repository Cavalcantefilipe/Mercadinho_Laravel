<?php

namespace App\Repositories\ItensVenda;

use App\Models\ItensVenda;
use App\Repositories\ItensVenda\ItensVendaRepositoryInterface;


class ItensVendaRepositoryEloquent implements ItensVendaRepositoryInterface
{
    private $itensVenda;

    public function __construct(ItensVenda $itensVenda)
    {
        $this->itensVenda = $itensVenda;
    }


    public function getItensVendas()
    {
        $query = $this->itensVenda->select();
        return $query->get();
    }

    public function getItensVenda(int $id)
    {
        return $this->itensVenda->select()
            ->where('idItensVenda', $id)
            ->first();
    }

    public function createItensVenda(array $dados)
    {
        return $this->itensVenda->create($dados);
    }

    public function updateItensVenda(int $id, array $dados)
    {
        return $this->itensVenda
            ->where('idItensVenda', $id)
            ->update($dados);
    }

    public function deleteItensVenda(int $id)
    {
        $query = $this->itensVenda->find($id);
        return $query->delete();
    }
}
