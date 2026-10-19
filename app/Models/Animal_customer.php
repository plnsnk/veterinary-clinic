<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal_customer extends Model
{

    protected $table = 'animal_user';

    protected $fillable = ['animal_id', 'user_id', 'created_at'];
    public $timestamps = false;
    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function animalUser()
    {
        return $this->belongsTo(Animal_customer::class, 'animal_user_id');
    }
}
