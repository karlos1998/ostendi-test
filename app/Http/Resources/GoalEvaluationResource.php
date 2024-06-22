<?php

namespace App\Http\Resources;

use App\Models\GoalEvaluation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin GoalEvaluation
 */
class GoalEvaluationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee' => EmployeeResource::make($this->employee),
            'goal' => GoalResource::make($this->goal),
            'progress' => $this->progress,
        ];
    }
}
