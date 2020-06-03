<?php

namespace App\Repositories\Cliente;

use App\Models\Cliente;
use App\Repositories\Cliente\ClienteRepositoryInterface;


class ClienteRepositoryEloquent implements ClienteRepositoryInterface
{
    private $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }


    public function getClientes()
    {
        $query = $this->cliente->select();
        return $query->get();
    }

    public function getCliente(int $id)
    {
        return $this->cliente->select()
            ->where('idCliente', $id)
            ->first();
    }

    public function createCliente(array $dados)
    {
        return $this->cliente->create($dados);
    }

    public function updateCliente(int $id, array $dados)
    {
        return $this->cliente
            ->where('idCliente', $id)
            ->update($dados);
    }

    public function deleteCliente(int $id)
    {
        $query = $this->cliente->find($id);
        return $query->delete();
    }
}
