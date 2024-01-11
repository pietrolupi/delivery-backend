<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Restaurant extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function types(){
        return $this->belongsToMany(Type::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'image',
    ];

}
