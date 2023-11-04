<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function form()
    {
        return view('cadastra_produto');
    }

    public function create(Request $request)
    {
        $product = new Product($request->all());

        //response json
       //response()->json([], 201);

        if ($product->save() === true){
            return response()->json($product, 201);
        }
        return response()->json(["error" => "Erro ao cadastrar"], 400);
    }

    public function getProduct(int $id)
    {
        $product = Product::find($id);
        return response()->json($products);
    }

    public function getAll(Request $request)
    {
        //se tem: ?category=valor
        $category = $request->input('category');

        //se tem: ?name=valor
        $name = $request->input('name');

        if($category) {
            $products = Product::where('category', $category)->get();
        } elseif($name){
            $products = Product::where('name', $name)->get();
        } else {
            $products = Product::all();
        }
        return response()->json($products);
    }

    public function update(int $id, Request $request)
    {
        //Conceito do Put em Rest, é substituir
        $product = Product::findOrFail($id);

        //estamos preenchendo o que veio da request no produtos que selecionamos pelo ID
        $product->fill($request->all());

        if ($product->save()) {
            return response()->json($product, 202);
        }
        return response('Erro ao atualizar', 400);
    }

    public function delete(int $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(["error" => "Produto não encontrado"], 404);
        }

        if ($product->delete()) {
            return response()->json(["message" => "Produto excluído com sucesso"], 200);
        }

        return response()->json(["error" => "Erro ao excluir o produto"], 500);
    }


}
