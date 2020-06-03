<?php

namespace App\Services\Venda;

use Illuminate\Database\QueryException;
use App\Repositories\Venda\VendaRepositoryInterface as Venda;

class VendaService
{

    private $venda;

    public function __construct(Venda $venda)
    {
        $this->venda = $venda;
    }

    public function getVendas()
    {
        try {
            return $this->venda->getVendas();
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getVenda(int $id)
    {
        try {
            return $this->venda->getVenda($id);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function createVenda(array $dados)
    {
        try {
            return $this->venda->createVenda($dados);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function updateVenda(int $id, array $dados)
    {
        try {
            return $this->venda->updateVenda($id, $dados);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function deleteVenda(int $id)
    {
        try {
            return $this->venda->deleteVenda($id);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
