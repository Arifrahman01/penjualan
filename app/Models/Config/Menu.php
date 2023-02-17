<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu  extends Model
{
    protected $table = 'menu';
    // protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

}