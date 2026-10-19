<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class animalType extends Model
{
    use HasFactory;
    protected $table = "animal_types";
    public $timestamps = false;
    public function animals()
    {
        return $this->hasMany(Animal::class, 'animal_type_id');
    }
//    public function breed()
//    {
//        return $this->hasMany(Breed::class);
//    }
}
