<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Venda\VendaService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class VendaController extends Controller
{

    private $vendaSrv;

    public function __construct(VendaService $vendaSrv)
    {
        $this->vendaSrv = $vendaSrv;
    }

    public function getVendas()
    {
        $data = $this->vendaSrv->getVendas();

        if (isset($data['error'])) {
            return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            return response()->json($data, Response::HTTP_OK);
        }
    }

    public function getVenda(int $id)
    {
        $validacao = Validator::make(
            [
                'idVenda' => $id
            ],
            [
                'idVenda' => 'required|exists:venda,idVenda'
            ],
            [
                'required'    => 'O campo :attribute é obrigatório.',
                'exists'      => 'O :attribute deve estar cadastrado.'
            ]
        );

        if ($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $data = $this->vendaSrv->getVenda($id);
            return response()->json($data, Response::HTTP_OK);
        }
    }

    public function createVenda(Request $request)
    {
        $validacao = Validator::make(
            $request->all(),
            [
                'total'         => 'required|max:30',
                'idCliente'         => 'required|numeric|exists:cliente,idCliente',

            ],
            [
                'max'          => 'O :attribute deve ter no maximo :max caracteres.',
				'numeric'      => 'O campo :attribute deve ser numérico.',
				'required'     => 'O campo :attribute é obrigatório.',
                'exists'       => 'O :attribute deve estar cadastrado.',
            ]
        );
        if ($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $data = $this->vendaSrv->createVenda($request->all());
            if (isset($data['error'])) {
                return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return response()->json($data, Response::HTTP_OK);
            }
        }
    }

    public function updateVenda(int $id, Request $request)
    {

        $validacao = Validator::make(
            $request->all(),
            [
                'total'         => 'required|max:30',
                'idCliente'         => 'required|numeric|exists:cliente,idCliente',

            ],
            [
                'max'          => 'O :attribute deve ter no maximo :max caracteres.',
				'numeric'      => 'O campo :attribute deve ser numérico.',
				'required'     => 'O campo :attribute é obrigatório.',
                'exists'       => 'O :attribute deve estar cadastrado.',
            ]
        );

        if ($validacao->fails()) {

            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {

            $carro = $this->vendaSrv->updateVenda($id,$request->all());

            if (isset($carro['error'])) {

                return response()->json($carro, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($carro, Response::HTTP_OK);
            }
        }
    }

    public function deleteVenda(int $id)
    {

        $validation = Validator::make(
            [
                'idVenda' => $id
            ],
            [
                'idVenda' => 'required|exists:venda,idVenda',
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

            $carro = $this->vendaSrv->deleteVenda($id);

            if (isset($carro['error'])) {

                return response()->json($carro, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($carro, Response::HTTP_OK);
            }
        }
    }
}
