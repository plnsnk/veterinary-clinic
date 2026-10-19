<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'animal_type_id',
        'name',
        'weight',
        'age',
        'diseas_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(animalType::class, 'animal_type_id');
    }

    public function diseas()
    {
        return $this->belongsTo(Diseas::class, 'diseas_id');
    }
    public function application()
    {
        return $this->belongsToMany(Application::class);
    }

//    public function breed()
//    {
//        return $this->belongsTo(Breed::class);
//    }

}