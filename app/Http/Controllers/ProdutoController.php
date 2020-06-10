<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Produto\ProdutoService;
use App\Http\Controllers\Controller;
use App\Services\ItensVenda\ItensVendaService;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class ProdutoController extends Controller
{

    private $produtoSrv;
    private $itensVendaSrv;

    public function __construct(ProdutoService $produtoSrv, ItensVendaService $itensVendaSrv)
    {
        $this->produtoSrv       = $produtoSrv;
        $this->itensVendaSrv    = $itensVendaSrv;
    }

    public function getProdutos($descricao = null)
    {
        $data = $this->produtoSrv->getProdutos($descricao);

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
                'produto.*.descricao'       => 'required|unique:produto,descricao|max:100',
                'produto.*.quantidade'      => 'required|numeric|min:0',
                'produto.*.preco'           => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0'

            ],
            [
                'max'          => 'O :attribute deve ter no maximo :max caracteres.',
                'numeric'      => 'O campo :attribute deve ser numérico.',
                'required'     => 'O campo :attribute é obrigatório.',
                'exists'       => 'O :attribute deve estar cadastrado.',
                'min'          => 'O valor minimo do :attribute é 0',
                'unique'       => 'Já existe produto com essa descricao'
            ]
        );
        if ($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $create = $request['produto'];
            $data = $this->produtoSrv->createProduto($create);
            if (isset($data['error'])) {
                return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return response()->json($data, Response::HTTP_OK);
            }
        }
    }

    public function updateProduto(int $id, Request $request)
    {
        $produto = $this->produtoSrv->getProduto($id);
        if (!$produto) {
            $error['error']  = 'Produto não existe';
            return response()->json($error, Response::HTTP_BAD_REQUEST);
        }
        if (!$request['descricao'] && !$request['quantidade'] && !$request['preco']) {
            $error['error'] = 'Sem campos para Alteracao';
            return response()->json($error, Response::HTTP_BAD_REQUEST);
        }

        $request['descricao'] = $request['descricao'] == null ? $produto['descricao'] : $request['descricao'];
        $request['quantidade'] = $request['quantidade'] == null ? $produto['quantidade'] : $request['quantidade'];
        $request['preco'] = $request['preco'] == null ? $produto['preco'] : $request['preco'];

        $data = $request->all();
        $validacao = Validator::make(
            $data,
            [
                'descricao'         => 'required',
                'quantidade'        => 'required|numeric|min:0',
                'preco'             => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|min:0'

            ],
            [
                'max'          => 'O :attribute deve ter no maximo :max caracteres.',
                'numeric'      => 'O campo :attribute deve ser numérico.',
                'required'     => 'O campo :attribute é obrigatório.',
                'exists'       => 'O :attribute deve estar cadastrado.',
                'min'          => 'O valor minimo do :attribute é 0',
                'unique'       => 'Já existe produto com essa :attribute'
            ]
        );

        if ($validacao->fails()) {

            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {

            $descricaoDuplicada = $this->produtoSrv->getProdutos($data['descricao']);
            if (count($descricaoDuplicada) > 0) {
                if ($descricaoDuplicada[0]['idProduto'] != $id) {
                    $error['error'] = 'Descricao Produto Já existe';
                    return response()->json($error, Response::HTTP_BAD_REQUEST);
                }
            }

            $produto = $this->produtoSrv->updateProduto($id, $data);

            if (isset($data['error'])) {

                return response()->json($produto, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($produto, Response::HTTP_OK);
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

            $produtoEmItemVenda = $this->itensVendaSrv->getItensVendas(0, $id);
            if (count($produtoEmItemVenda) != 0) {
                $error['error']  = 'Produto tem Venda no sistema';
                return response()->json($error, Response::HTTP_BAD_REQUEST);
            }
            $produto = $this->produtoSrv->deleteProduto($id);

            if (isset($produto['error'])) {

                return response()->json($produto, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($produto, Response::HTTP_OK);
            }
        }
    }
}
