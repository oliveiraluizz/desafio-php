<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'categoria',
        'nome',
        'preco',
        'composicao',    
        'tamanho',
        'qtdProduto'

    ];

    public function imagens()
    {
        return $this->hasMany(imagem::class, 'produto_id', 'id');
    }
}
