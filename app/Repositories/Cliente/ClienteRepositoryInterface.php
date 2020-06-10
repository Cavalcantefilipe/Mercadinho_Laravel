<?php

namespace App\Repositories\Cliente;

interface ClienteRepositoryInterface
{
    public function getClientes(int $cpf);
    public function getCliente(int $id);
    public function createCliente(array $dados);
    public function updateCliente(int $id,array $dados);
    public function deleteCliente(int $id);
}
