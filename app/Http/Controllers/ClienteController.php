<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteStoreFormRequest;
use App\Http\Requests\ClienteUpdateFormRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function store (ClienteStoreFormRequest $request) {
        $result = Cliente::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Dados Cadastrados',
            'data'=> $result
        ]);
    }

    public function index (){
        $result = Cliente::all();

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }

    public function show ($id) {
        $result = Cliente::find($id);

        if($result == null){
            return response()->json([
                'status' => false,
                'message' => 'O Cliente não foi cadastrado ou não foi encontrado'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }

    public function update(ClienteUpdateFormRequest $request, $id) {
        $result = Cliente::find($id);

        if(isset($request->nome)){
            $result->nome = $request->nome;
        }

        if(isset($request->email)){
            $result->email = $request->email;
        }

        if(isset($request->telefone)){
            $result->telefone = $request->telefone;
        }

        if(isset($request->endereco)){
            $result->endereco = $request->endereco;
        }

        $result->update();

        return response()->json([
            'status' => true,
            'message' => 'Atualizado com sucesso'
        ]);

    }

    public function destroy ($id) {
        $result = Cliente::find($id);

        if($result == null){
            return response()->json([
                'status' => false,
                'message' => 'O Cliente não foi encontrado'
            ]);
        }

        $result->delete();

        return response()->json([
            'status' => true,
            'message' => 'Excluído com sucesso'
        ]);
    }

}
