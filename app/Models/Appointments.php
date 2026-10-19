<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'branch_id',
        'date',
        'time',
        'status_id'
    ];

    // Связи
    public function applications()
    {
        return $this->hasMany(Application::class, 'appointments_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
