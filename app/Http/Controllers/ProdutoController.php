<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoStoreFormRequest;
use App\Http\Requests\ProdutoUpdateFormRequest;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function store (ProdutoStoreFormRequest $request) {
        $result = Produto::create([
            'nome' => $request->nome,
            'codigo' => $request->codigo,
            'preco' => $request->preco,
            'quantidade_estoque' => $request->quantidade_estoque
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Dados Cadastrados'
        ]);
    }

    public function index (){
        $result = Produto::all();

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }

    public function show ($id) {
        $result = Produto::find($id);

        if($result == null){
            return response()->json([
                'status' => false,
                'message' => 'O Produto não foi cadastrado ou não foi encontrado'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }

    public function update(ProdutoUpdateFormRequest $request, $id) {
        $result = Produto::find($id);

        if(isset($request->nome)){
            $result->nome = $request->nome;
        }

        if(isset($request->codigo)){
            $result->codigo = $request->codigo;
        }

        if(isset($request->preco)){
            $result->preco = $request->preco;
        }

        if(isset($request->quantidade_estoque)){
            $result->quantidade_estoque = $request->quantidade_estoque;
        }

        $result->update();

        return response()->json([
            'status' => true,
            'message' => 'Atualizado com sucesso'
        ]);

    }

    public function destroy ($id) {
        $result = Produto::find($id);

        if($result == null){
            return response()->json([
                'status' => false,
                'message' => 'O produto não foi encontrado'
            ]);
        }

        $result->delete();

        return response()->json([
            'status' => true,
            'message' => 'Excluído com sucesso'
        ]);
    }

}
