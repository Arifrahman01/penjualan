<?php

namespace App\Models;

use App\Models\Barang as ModelsBarang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "transaksi";

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function barang() {
        return $this->belongsTo(Barang::class);
    }
    public function user() {
        return $this->belongsTo(User::class, 'created_by','id');
    }


    public function scopeSearch($query,array $search)
    {  
        $query->when($search['s'] ?? false,fn($query,$search) => 
            $query->where('code',  'like', '%'.$search.'%')
            ->orWhere('description','like', '%'.$search .'%')
        );
        $query->when($search['a'] ?? false,fn($query,$search) => 
            $query->where('supplier_id',  '=', $search)
        );
        $query->when($search['b'] ?? false,fn($query,$search) => 
            $query->where('barang_id',  '=', $search)
        );
        $query->when($search['d'] ?? false,fn($query,$search) => 
            $query->whereBetween('created_at',[ (explode(" - ", $search))[0],  (explode(" - ", $search)[1])])  
        );
    }
}
