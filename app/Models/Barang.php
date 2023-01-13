<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "barang";

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
}
