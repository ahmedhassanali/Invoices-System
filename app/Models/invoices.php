<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];


    public function categories()
    {
        return $this->belongsTo(categories::class);
    }
    protected $datas = ['deleted_at'];
}
