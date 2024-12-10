<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'Titulo',
        'Descricao',
        'Valor',
        'project_image',
        'Id_User',
        'removed'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'Id_User'); // Um produto pertence a um usuário
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function isFavorited()
    {
        return Favorite::where('user_id', Auth::id())
                    ->where('product_id', $this->id)
                    ->exists();
    }
}
