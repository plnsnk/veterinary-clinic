<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = "services";
     public $timestamps = false;

    protected $fillable = [
        'name',
        'price',
        'category_id',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function animalTypes()
    {
        return $this->belongsToMany(animalType::class, 'service_prices', 'service_id',
            'animal_type_id')->withPivot('price', 'weight');
    }

}