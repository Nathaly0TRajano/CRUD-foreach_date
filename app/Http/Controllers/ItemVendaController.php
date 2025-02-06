<?php

namespace App\Http\Controllers;

use App\Models\ItemVenda;
use Illuminate\Http\Request;

class ItemVendaController extends Controller
{
    // Store se localiza em VendaController

    public function index(){
        $result = ItemVenda::all();

        return response()->json([
            'status'=> true,
            'data' => $result
        ]);
    }

    public function show($id)
    {
        $result = ItemVenda::find($id);

        if ($result == null) {
            return response()->json([
                'status' => false,
                'message' => 'O item da venda não foi cadastrada ou não foi encontrado'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }

    public function update(Request $request, $id)
    {
        $result = ItemVenda::find($id);

        if (isset($request->venda_id)) {
            $result->venda_id = $request->venda_id;
        }

        if (isset($request->produto_id)) {
            $result->produto_id = $request->produto_id;
        }

        if (isset($request->quantidade)) {
            $result->quantidade = $request->quantidade;
        }

        if (isset($request->preco_unitario)) {
            $result->preco_unitario = $request->preco_unitario;
        }

        if (isset($request->subtotal_item)) {
            $result->subtotal_item = $request->subtotal_item;
        }

        $result->update();

        return response()->json([
            'status' => true,
            'message' => 'Atualizado com sucesso'
        ]);
    }

    public function destroy($id)
    {
        $result = ItemVenda::find($id);

        if ($result == null) {
            return response()->json([
                'status' => false,
                'message' => 'Não foi possível encontrar o item da venda'
            ]);
        }

        $result->delete();

        return response()->json([
            'status' => true,
            'message' => 'Excluído com sucesso'
        ]);
    }
}

