<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submarket extends Model
{
    use HasFactory;

    protected $table = 'bills';
    protected $fillable =[];

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
