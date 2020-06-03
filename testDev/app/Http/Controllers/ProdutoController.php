<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Produto\ProdutoService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class ProdutoController extends Controller
{

    private $produtoSrv;

    public function __construct(ProdutoService $produtoSrv)
    {
        $this->produtoSrv = $produtoSrv;
    }

    public function getProdutos()
    {
        $data = $this->produtoSrv->getProdutos();

        if (isset($data['error'])) {
            return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            return response()->json($data, Response::HTTP_OK);
        }
    }

    public function getProduto(int $id)
    {
        $validacao = Validator::make(
            [
                'idProduto' => $id
            ],
            [
                'idProduto' => 'required|exists:produto,idProduto'
            ],
            [
                'required'    => 'O campo :attribute é obrigatório.',
                'exists'      => 'O :attribute deve estar cadastrado.'
            ]
        );

        if ($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $data = $this->produtoSrv->getProduto($id);
            return response()->json($data, Response::HTTP_OK);
        }
    }

    public function createProduto(Request $request)
    {
        $validacao = Validator::make(
            $request->all(),
            [
                'produto.*.descricao'       => 'required|max:100',
                'produto.*.quantidade'      => 'required|numeric',
                'produto.*.preco'           => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'

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
            $data = $this->produtoSrv->createProduto($request->all());
            if (isset($data['error'])) {
                return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return response()->json($data, Response::HTTP_OK);
            }
        }
    }

    public function updateProduto(int $id, Request $request)
    {

        $data = $request->all();

        $validacao = Validator::make(
            $data,
            [
                'descricao'         => 'required|max:100',
                'quantidade'        => 'required|numeric',
                'preco'             => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'

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

            $carro = $this->produtoSrv->updateProduto($id,$data);

            if (isset($data['error'])) {

                return response()->json($carro, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($carro, Response::HTTP_OK);
            }
        }
    }

    public function deleteProduto(int $id)
    {

        $validation = Validator::make(
            [
                'idProduto' => $id
            ],
            [
                'idProduto' => 'required|numeric|exists:produto,idProduto',
            ],
            [
                'numeric'       => 'O campo :attribute deve ser numérico.',
                'required'      => 'O campo :attribute é obrigatório.',
                'exists'        => 'O :attribute deve estar cadastrado.'
            ]
        );
        if ($validation->fails()) {

            return response()->json($validation->errors(), Response::HTTP_BAD_REQUEST);
        } else {

            $carro = $this->produtoSrv->deleteProduto($id);

            if (isset($carro['error'])) {

                return response()->json($carro, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($carro, Response::HTTP_OK);
            }
        }
    }
}
