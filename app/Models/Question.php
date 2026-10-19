<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'status_id',
        'answer',
        'user_id'
    ];

    protected $table = 'questions';

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
