<?php

namespace App\Services;

use App\Http\Resources\GoalEvaluationResource;
use App\Models\GoalEvaluation;

final class GoalEvaluationService {
    public function __construct(private readonly GoalEvaluation $goalEvaluation)
    {
    }

    public function store(array $data)
    {
        $goalEvaluation = $this->goalEvaluation->firstOrNew(
            [
                'employee_id' => $data['employee_id'],
                'goal_id' => $data['goal_id'],
            ]
        );

        $goalEvaluation->progress = $data['progress'];

        $goalEvaluation->save();

        return GoalEvaluationResource::make($goalEvaluation);
    }
}
