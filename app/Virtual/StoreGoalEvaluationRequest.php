<?php

namespace App\Virtual;

use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'Store Goal Evaluation',
    type: 'object'
)]
class StoreGoalEvaluationRequest
{
    #[OA\Property(format: 'int64')]
    public int $goal_id;

    #[OA\Property(format: 'int64')]
    public int $employee_id;

    #[OA\Property(format: 'int64')]
    public int $progress;
}
