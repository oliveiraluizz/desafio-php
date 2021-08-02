<?php

namespace App\Http\Controllers;

use App\Models\imagem;
use Illuminate\Http\Request;

class ImagemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registros = imagem::all();
        return json_encode($registros);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $imanges_qtd = imagem::where('produto_id', $request->produto_id)->count();

        if($imanges_qtd<3){
        $imagem = $request->file('imagem');
        $imagem_url = $imagem->store('imagem');
        $imagemSalvar = imagem::create([
            'produto_id' => $request->produto_id,
            'caminho' => $imagem_url
        ]);
        return json_encode($imagemSalvar);
    }else{
        return 'Numero de imagens por produto excedido';
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = imagem::find($id);
        return json_encode($produto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

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

        $imagem = imagem::find($id)->update($dados);
        return json_encode($imagem);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagem = imagem::find($id)->delete();
        return json_encode($imagem);
    }

    public function rules($id = null)
    {
        //unique:produtos

        return [
            'produto_id' => 'required|exists:produtos',

        ];
    }
    public function feedback()
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'exists' => 'Produto não encontrado',


        ];
    }
}
