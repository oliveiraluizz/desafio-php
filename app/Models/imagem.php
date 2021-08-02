<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imagem extends Model
{
    use HasFactory;
    protected $table = 'imagens';

    protected $fillable = [
      'caminho',
      'produto_id'
    ];

    

}
