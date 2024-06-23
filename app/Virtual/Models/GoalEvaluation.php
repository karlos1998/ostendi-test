<?php

namespace App\Virtual\Models;

use OpenApi\Attributes as OA;

#[OA\Schema(title: 'Goal Evaluation', description: 'Employee Goal Evaluation')]
class GoalEvaluation
{
    #[OA\Property(description: 'ID of the goal evaluation', format: 'int64')]
    public int $id;

    #[OA\Property(
        ref: '#/components/schemas/Goal',
        description: 'Goal associated with the evaluation',
        type: 'object'
    )]
    public Goal $goal;

    #[OA\Property(
        ref: '#/components/schemas/Employee',
        description: 'Employee associated with the evaluation',
        type: 'object'
    )]
    public Employee $employee;

    #[OA\Property(description: 'Goal evaluation progress', format: 'int64')]
    public int $progress;
}
