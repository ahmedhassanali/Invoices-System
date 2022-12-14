<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name','description','categories_id'
    ];
    public function categories()
    {
        return $this->belongsTo(categories::class);
    }
}
