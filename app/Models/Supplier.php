<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "supplier";

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function scopeSearch($query,array $search)
    {  
        $query->when($search['s'] ?? false,fn($query,$search) => 
            $query->where('code',  'like', '%'.$search.'%')
            ->orWhere('description','like', '%'.$search .'%')
        );
    }

}
