<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Venda\VendaService;
use App\Services\Cliente\ClienteService;
use App\Services\Produto\ProdutoService;
use Illuminate\Support\Facades\Validator;
use App\Services\ItensVenda\ItensVendaService;
use Symfony\Component\HttpFoundation\Response;

date_default_timezone_set('America/Sao_Paulo');
class VendaController extends Controller
{

    private $vendaSrv;
    private $produtoSrv;
    private $clienteSrv;
    private $itensVendaSrv;

    public function __construct(
        VendaService $vendaSrv,
        ProdutoService $produtoSrv,
        ClienteService $clienteSrv,
        ItensVendaService $itensVendaSrv
    ) {
        $this->vendaSrv = $vendaSrv;
        $this->produtoSrv = $produtoSrv;
        $this->clienteSrv = $clienteSrv;
        $this->itensVendaSrv = $itensVendaSrv;
    }

    public function getVendas($id = null)
    {
        $data = $this->vendaSrv->getVendas($id);

        if (isset($data['error'])) {
            return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            return response()->json($data, Response::HTTP_OK);
        }
    }

    public function getItensVenda($id = null)
    {
        $data = $this->itensVendaSrv->getItensVendas($id);
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
                'total'         => 'sometimes|max:0|min:0',
                'idCliente'         => 'required|numeric|exists:cliente,idCliente',

            ],
            [
                'max'          => 'O :attribute deve ter no maximo :max caracteres.',
                'min'          => 'O :attribute deve ter no minimo :min caracteres.',
                'numeric'      => 'O campo :attribute deve ser numérico.',
                'required'     => 'O campo :attribute é obrigatório.',
                'exists'       => 'O :attribute deve estar cadastrado.',
            ]
        );
        $request['total'] = 0;
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

    public function addItemVenda($id, Request $request)
    {

        $validacao = Validator::make(
            $request->all(),
            [
                'itensVenda.*.idProduto'         => 'required|numeric|exists:produto,idProduto',
                'itensVenda.*.quantidadeProduto' => 'required|numeric|min:0',

            ],
            [
                'max'          => 'O :attribute deve ter no maximo :max caracteres.',
                'min'          => 'O :attribute deve ter no minimo :min caracteres.',
                'numeric'      => 'O campo :attribute deve ser numérico.',
                'required'     => 'O campo :attribute é obrigatório.',
                'exists'       => 'O :attribute deve estar cadastrado.'
            ]
        );

        if ($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $venda = $this->vendaSrv->getVenda($id);
            if ($venda['finalizado'] != null) {
                $error['error']  = 'Venda já finalizada';
                return response()->json($error, Response::HTTP_BAD_REQUEST);
            }

            for ($i = 0; $i < count($request['itensVenda']); $i++) {
                for ($j = 0; $j < count($request['itensVenda']); $j++) {
                    if ($request['itensVenda'][$i]['idProduto'] == $request['itensVenda'][$j]['idProduto'] && $j != $i) {
                        $error['error']  = 'Não permitido enviar produto identico para mesma venda ';
                        return response()->json($error, Response::HTTP_BAD_REQUEST);
                    }
                }
            }
            $dados = $request['itensVenda'];
            foreach ($dados as &$dado) {
                $produto = $this->produtoSrv->getProduto($dado['idProduto']);
                if ($produto['quantidade'] < $dado['quantidadeProduto']) {
                    $error['error']  = 'Quantidade de Produto indisponivel quatidade disponivel em estoque de ' . $produto['descricao'] . 'é de' . $produto['quantidade'];
                    return response()->json($error, Response::HTTP_BAD_REQUEST);
                } else {
                    $produto['quantidade'] -= $dado['quantidadeProduto'];
                    $updateProduto = $this->produtoSrv->updateProduto($dado['idProduto'], $produto->getattributes());
                    $dado['valorProduto'] = $produto['preco'];
                    $total =  $dado['quantidadeProduto'] * $produto['preco'];
                    $dado['idVenda'] = $id;
                    $venda['total'] += $total;
                }
            }
            $data = $this->itensVendaSrv->createItensVenda($dados);
            if (isset($data['error'])) {
                return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                $updateVenda = $this->vendaSrv->updateVenda($id, $venda->getattributes());
                if (isset($updateVenda['error'])) {
                    return response()->json($updateVenda, Response::HTTP_INTERNAL_SERVER_ERROR);
                } else {
                    return response()->json($updateVenda, Response::HTTP_OK);
                }
            }
        }
    }

    public function removeItemVenda($id)
    {
        $validation = Validator::make(
            [
                'idItemVenda' => $id
            ],
            [
                'idItemVenda' => 'required|exists:itensVenda,idItemVenda',
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

            $itemVenda = $this->itensVendaSrv->getItensVenda($id);
            $venda = $this->vendaSrv->getVenda($itemVenda['idVenda']);
            if ($venda['finalizado'] != null) {
                $error['error']  = 'Venda já finalizada';
                return response()->json($error, Response::HTTP_BAD_REQUEST);
            }
            $venda['total'] -= ($itemVenda['valorProduto'] * $itemVenda['quantidadeProduto']);
            $produto = $this->produtoSrv->getProduto($itemVenda['idProduto']);
            $produto['quantidade'] +=$itemVenda['quantidadeProduto'];
            $produtoAtualizado = $this->produtoSrv->updateProduto($itemVenda['idProduto'],$produto->getattributes());
            $vendaAtualizada = $this->vendaSrv->updateVenda($itemVenda['idVenda'], $venda->getattributes());
            $itemVendaExcluido = $this->itensVendaSrv->deleteItensVenda($id);
            if (isset($itemVendaExcluido['error'])) {

                return response()->json($itemVendaExcluido, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return response()->json($itemVendaExcluido, Response::HTTP_OK);
            }
        }
    }

    public function finalizarVenda($id)
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
            $venda = $this->vendaSrv->getVenda($id);
            if ($venda['finalizado'] != null) {
                $error['error']  = 'Venda já finalizada';
                return response()->json($error, Response::HTTP_BAD_REQUEST);
            }

            $venda['finalizado'] = Carbon::now()->toDateTimeString();

            $vendaFinalizada = $this->vendaSrv->updateVenda($id, $venda->getattributes());
            if (isset($vendaFinalizada['error'])) {

                return response()->json($vendaFinalizada, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($vendaFinalizada, Response::HTTP_OK);
            }
        }
    }

    public function updateVenda(int $id, Request $request)
    {
        $request['idVenda'] = $id;
        $validacao = Validator::make(
            $request->all(),
            [
                'idVenda'           => 'required|numeric|exists:venda,idVenda',
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
            $venda = $this->vendaSrv->getVenda($id);
            if ($venda['finalizado'] != null) {
                $error['error']  = 'Venda já finalizada';
                return response()->json($error, Response::HTTP_BAD_REQUEST);
            }


            $venda = $this->vendaSrv->updateVenda($id, $request->all());

            if (isset($venda['error'])) {

                return response()->json($venda, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($venda, Response::HTTP_OK);
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

            $venda = $this->vendaSrv->getVenda($id);
            if ($venda['finalizado'] != null) {
                $error['error']  = 'Venda já finalizada';
                return response()->json($error, Response::HTTP_BAD_REQUEST);
            }

            $venda = $this->vendaSrv->deleteVenda($id);

            if (isset($venda['error'])) {

                return response()->json($venda, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($venda, Response::HTTP_OK);
            }
        }
    }
}
