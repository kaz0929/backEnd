<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
       'types_id' ,'sort', 'img', 'title', 'content'
    ];

    public function products_types()
    {
        return $this->belongsTo('App\ProductTypes', 'types_id');
    }
}
