<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CategoryModal extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'id',
        'category_name',
        'status',
    ];
}
