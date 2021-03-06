<?php

namespace App\Services\ItensVenda;

use Illuminate\Database\QueryException;
use App\Repositories\ItensVenda\ItensVendaRepositoryInterface as ItensVenda;

class ItensVendaService
{

    private $itensVenda;

    public function __construct(ItensVenda $itensVenda)
    {
        $this->itensVenda = $itensVenda;
    }

    public function getItensVendas($idVenda = null,$idProduto = null)
    {
        try {
            return $this->itensVenda->getItensVendas($idVenda,$idProduto);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getItensVenda(int $id)
    {
        try {
            return $this->itensVenda->getItensVenda($id);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function createItensVenda(array $dados)
    {
        try {
            if (count($dados) > 0) {
                foreach ($dados as $dado) {
                 $this->itensVenda->createItensVenda($dado);
                }
                return $dados;
            }
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function updateItensVenda(int $id, array $dados)
    {
        try {
            return $this->itensVenda->updateItensVenda($id, $dados);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function deleteItensVenda(int $id)
    {
        try {
            return $this->itensVenda->deleteItensVenda($id);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
