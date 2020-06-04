<?php

namespace App\Services\Cliente;

use Illuminate\Database\QueryException;
use App\Repositories\Cliente\ClienteRepositoryInterface as Cliente;

class ClienteService
{

    private $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function getClientes()
    {
        try {
            return $this->cliente->getClientes();
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getCliente(int $id)
    {
        try {
            return $this->cliente->getCliente($id);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function createCliente(array $dados)
    {
        try {
            return $this->cliente->createCliente($dados);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function updateCliente(int $id, array $dados)
    {
        try {
            return $this->cliente->updateCliente($id, $dados);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function deleteCliente(int $id)
    {
        try {
            return $this->cliente->deleteCliente($id);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
