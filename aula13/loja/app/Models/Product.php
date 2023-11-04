<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //Sao os campos da tabela que não podem ser armazanados diretamente no construtor model
    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'profile'
    ];


}
