<?php

namespace App\Http\Controllers;

use App\Models\ItemVenda;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function store(Request $request)
    {

        $result = Venda::create([
            'cliente_id' => $request->cliente_id,
            'data_venda'=> date('Y-m-d H:i:s'),
            'desconto'=>$request->desconto,
            'subtotal'=> 0,
            'total'=> 0
        ]);

        $subtotal = 0;
        foreach($request->itens as $item){
            $subtotal += $item['quantidade'] * $item['preco']; 
            $produto = Produto::find($item['produto_id']);
            if($produto->quantidade_estoque == 0){
                return response()->json([
                    'status'=>false,
                    'message'=> 'Não existem produtos suficientes para sua compra.',
                ]);
            } 
            $produto->quantidade_estoque =  $produto->quantidade_estoque - $item['quantidade'];

            $produto->update();

            $item_venda = ItemVenda::create([
                'venda_id' => $result->id,
                'produto_id'=> $item['produto_id'],
                'quantidade'=> $item['quantidade'],
                'preco_unitario' => $item['preco'],
                'subtotal_item'=> $subtotal
            ]);
        }

        $result->subtotal = $subtotal;
        $result->total = $subtotal - $request->desconto; 
        $result->update();


        return response()->json([
            'status'=> true,
            'message'=> 'Venda efetuada',
            'data'=> $result
        ]);


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
