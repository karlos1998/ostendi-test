<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalEvaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'progress',
        'goal_id',
        'employee_id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

}
