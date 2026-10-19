<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diseas extends Model
{
    use HasFactory;
    protected $table = 'diseases';
    public $timestamps = false;
    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
