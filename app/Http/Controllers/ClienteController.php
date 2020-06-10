<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Cliente\ClienteService;
use App\Http\Controllers\Controller;
use App\Services\Venda\VendaService;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class ClienteController extends Controller
{

    private $clienteSrv;
    private $vendaSrv;

    public function __construct(ClienteService $clienteSrv, VendaService $vendaSrv)
    {
        $this->clienteSrv   = $clienteSrv;
        $this->vendaSrv     = $vendaSrv;
    }

    public function getClientes($cpf = null)
    {
        $data = $this->clienteSrv->getClientes($cpf);

        if (isset($data['error'])) {
            return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            return response()->json($data, Response::HTTP_OK);
        }
    }

    public function getCliente(int $id)
    {
        $validacao = Validator::make(
            [
                'idCliente' => $id
            ],
            [
                'idCliente' => 'required|exists:cliente,idCliente'
            ],
            [
                'required'    => 'O campo :attribute é obrigatório.',
                'exists'      => 'O :attribute deve estar cadastrado.'
            ]
        );

        if ($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $data = $this->clienteSrv->getCliente($id);
            return response()->json($data, Response::HTTP_OK);
        }
    }

    public function createCliente(Request $request)
    {
        $validacao = Validator::make(
            $request->all(),
            [
                'nome'          => 'required|max:100',
                'cpf/cnpj'      => 'required|unique:cliente,cpf/cnpj|cpf_cnpj',

            ],
            [
                'max'          => 'O :attribute deve ter no maximo :max caracteres.',
                'numeric'      => 'O campo :attribute deve ser numérico.',
                'required'     => 'O campo :attribute é obrigatório.',
                'exists'       => 'O :attribute deve estar cadastrado.',
                'unique'       => 'Já existe pessoa com esse :attribute'
            ]
        );

        if ($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $data = $this->clienteSrv->createCliente($request->all());
            if (isset($data['error'])) {
                return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return response()->json($data, Response::HTTP_OK);
            }
        }
    }

    public function updateCliente(int $id, Request $request)
    {
        $cliente = $this->clienteSrv->getCliente($id);
        if (!$cliente) {
            $error['error']  = 'Cliente não existe';
            return response()->json($error, Response::HTTP_BAD_REQUEST);
        }
        if (!$request['nome'] && !$request['cpf/cnpj']) {
            $error['error'] = 'Sem campos para Alteracao';
            return response()->json($error, Response::HTTP_BAD_REQUEST);
        }
        $request['nome'] = $request['nome'] == null ? $cliente['nome'] : $request['nome'];
        $request['cpf/cnpj'] = $request['cpf/cnpj'] == null ? $cliente['cpf/cnpj'] : $request['cpf/cnpj'];
        $validacao = Validator::make(
            $request->all(),
            [
                'nome'          => 'required|max:100',
                'cpf/cnpj'      => 'required|cpf_cnpj',

            ],
            [
                'max'          => 'O :attribute deve ter no maximo :max caracteres.',
                'numeric'      => 'O campo :attribute deve ser numérico.',
                'required'     => 'O campo :attribute é obrigatório.',
                'exists'       => 'O :attribute deve estar cadastrado.'
            ]
        );

        if ($validacao->fails()) {

            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $cpfDuplicado = $this->clienteSrv->getClientes($request['cpf/cnpj']);
            if (count($cpfDuplicado) > 0) {
                if ($cpfDuplicado[0]['idCliente'] != $id) {
                    $error['error'] = 'CPF Já existe';
                    return response()->json($error, Response::HTTP_BAD_REQUEST);
                }
            }
            $cliente = $this->clienteSrv->updateCliente($id, $request->all());

            if (isset($cliente['error'])) {

                return response()->json($cliente, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($cliente, Response::HTTP_OK);
            }
        }
    }

    public function deleteCliente(int $id)
    {

        $validation = Validator::make(
            [
                'idCliente' => $id
            ],
            [
                'idCliente' => 'required|numeric|exists:cliente,idCliente',
            ],
            [
                'numeric'      => 'O campo :attribute deve ser numérico.',
                'required' => 'O campo :attribute é obrigatório.',
                'exists' => 'O :attribute deve estar cadastrado.'
            ]
        );
        if ($validation->fails()) {

            return response()->json($validation->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $venda =  $this->vendaSrv->getVendas($id);
            if (count($venda) != 0) {
                $error['error']  = 'Cliente tem Venda no sistema';
                return response()->json($error, Response::HTTP_BAD_REQUEST);
            }
            $cliente = $this->clienteSrv->deleteCliente($id);

            if (isset($cliente['error'])) {

                return response()->json($cliente, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($cliente, Response::HTTP_OK);
            }
        }
    }
}
