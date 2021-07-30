<?php

namespace App\Http\Controllers;
use App\Models\produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    

    //metodo para listar os produtos
    public function index(){

        $registros = Produto::all();

        return json_encode($registros);


    }
    //metodo para adicionar os produtos
    public function adicionar(Request $req){

        $dados = $req->all();
       
        $produto = produto::create($dados);     
        return json_encode($produto);
    }

    //metodo para encontrar um produtos pelo codigo
    public function date($codigo){


        $produto = Produto::find($codigo);     
        return json_encode($produto);
    }

    //metodo para atualizar
    public function atualizar(Request $req, $codigo){

        $dados = $req->all();

        $produto = Produto::find($codigo)->update($codigo);     
        return json_encode($produto);
    }

    //metodo para deletar
    public function deletar($codigo){

        $produto = Produto::find($codigo)->delete($codigo);
        return json_encode($produto);
    }
}
