<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Cliente\ClienteService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class ClienteController extends Controller
{

    private $clienteSrv;

    public function __construct(ClienteService $clienteSrv)
    {
        $this->clienteSrv = $clienteSrv;
    }

    public function getClientes()
    {
        $data = $this->clienteSrv->getClientes();

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
        $this->validate($request, [
            'cpf_cnpj' => 'required|cpf_cnpj',
        ]);
        $validacao = Validator::make(
            $request->all(),
            [
                'nome'         => 'required|max:100',
                'cpf/cnpj'     => 'required|numeric',

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
        $this->validate($request, [
            'cpf/cnpj' => 'required|cpf_cnpj',
        ]);
        $validacao = Validator::make(
            $request->all(),
            [
                'nome'         => 'required|max:100',
                'cpf/cnpj'     => 'required|numeric',

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

            $cliente = $this->clienteSrv->deleteCliente($id);

            if (isset($cliente['error'])) {

                return response()->json($cliente, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($cliente, Response::HTTP_OK);
            }
        }
    }
}
