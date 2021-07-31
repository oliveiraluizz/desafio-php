<?php

namespace App\Http\Controllers;

use App\Models\produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registros = produto::all();
        return json_encode($registros);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate($this->rules(), $this->feedback());

        $dados = $request->all();

        $produto = produto::create($dados);
        return json_encode($produto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);
        return json_encode($produto);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->method() === "PUT") {
            //tudo
            $request->validate($this->rules($id), $this->feedback());
        } else {
            //parcial

            foreach ($this->rules($id) as $key => $rule) {
                if (array_key_exists($key, $request->all())) {
                    $regrasDinamicas[$key] =  $rule;
                }
            }
            $request->validate($regrasDinamicas, $this->feedback());
        }

        $dados = $request->all();

        $produto = Produto::find($id)->update($dados);
        return json_encode($produto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id)->delete();
        return json_encode($produto);
    }


    public function rules($id = null)
    {
        //unique:produtos

        return [
            'codigo' => 'required|min:3|max:10|unique:produtos,codigo,' . $id . '',
            'categoria' => 'required',
            'nome' => 'required',
            'preco' => 'required',
            'composicao' => 'required',
            'tamanho' => 'required',
            'qtdProduto' => 'required'
        ];
    }
    public function feedback()
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'codigo.min' => 'Codigo muito pequeno',
            'codigo.max' => 'Codigo muito grande'

        ];
    }
}
