<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryModal;

class GalleryModel extends Model
{
    protected $table = 'galleries';
    protected $fillable = [
        'id',
        'src',
        'alt',
        'category_id',
        'price',
        'status',
    ];
    public function category()
    {
        return $this->belongsTo(CategoryModal::class, 'category_id');
    }
}
