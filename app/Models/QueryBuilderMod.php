<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryBuilderMod extends Model
{
    use HasFactory;
    protected $table= 'querybuilder';
    protected $fillable = [
        'name', 'email',
        'city', 'address'
    ];
}
