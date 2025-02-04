<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function store(Request $request)
    {
        $result = Venda::create([
            'cliente_id' => $request->cliente_id,
            'data_venda'=> 
        ]);

        foreach($request->itens as $item){
            echo $item;
        };

        /**cadastrar a venda (cliente_id, data_venda deve ser a data e hora do sistema (sugestão, função date))
         * Percorrer os itens utilizando foreach. Ex.: foreach($request->itens as $item){ echo $item  }
         * calcular o valor total da venda, para isso, crie uma variavel iniciando com o valor zero, e faça a soma do total de todos os itens da venda
         * calcular o valor de cada item inserido no array
         * registrar o item no banco de dados utilizando ItemVenda::create([ 'quantidade' => $item->quantidade, 'subtotal' => $item->quantidade * $item->preco ])
         * 
         * **/ 

         
         }












         /*



        $result = Venda::create([
            'cliente_id' => $request->cliente_id,
            'subtotal' => $request->subtotal,
            'desconto' => $request->desconto,
            'total' => $request->total
        ]);

        $item = $request->itens;
        foreach ($request->itens as $item){
            echo $item;
        }

        return response()->json([
            'status' => true,
            'message' => 'Dados Cadastrados'
        ]);

     } */
    

    public function index()
    {
        $result = Venda::all();

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }

    public function show($id)
    {
        $result = Venda::find($id);

        if ($result == null) {
            return response()->json([
                'status' => false,
                'message' => 'O Venda não foi cadastrada ou não foi encontrado'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }

    public function update(Request $request, $id)
    {
        $result = Venda::find($id);

        if (isset($request->nome)) {
            $result->nome = $request->nome;
        }

        if (isset($request->email)) {
            $result->email = $request->email;
        }

        if (isset($request->telefone)) {
            $result->telefone = $request->telefone;
        }

        if (isset($request->endereco)) {
            $result->endereco = $request->endereco;
        }

        $result->update();

        return response()->json([
            'status' => true,
            'message' => 'Atualizado com sucesso'
        ]);
    }

    public function destroy($id)
    {
        $result = Venda::find($id);

        if ($result == null) {
            return response()->json([
                'status' => false,
                'message' => 'Não foi possível encontrar a venda'
            ]);
        }

        $result->delete();

        return response()->json([
            'status' => true,
            'message' => 'Excluída com sucesso'
        ]);
    }
}
