<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGoalEvaluationRequest;
use App\Http\Requests\UpdateGoalEvaluationRequest;
use App\Models\GoalEvaluation;
use App\Services\GoalEvaluationService;
use OpenApi\Attributes as OA;

class GoalEvaluationController extends Controller
{
    public function __construct(private readonly GoalEvaluationService $goalEvaluationService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    #[OA\Post(
        path: '/api/goal-evaluations',
        summary: 'Store new goal evaluations',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/StoreGoalEvaluationRequest')
        ),
        tags: ['Goal Evaluations'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful operation',
                content: new OA\JsonContent(ref: '#/components/schemas/GoalEvaluation')
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated'
            ),
            new OA\Response(
                response: 422,
                description: 'Unprocessable entity'
            ),
        ]
    )]
    public function store(StoreGoalEvaluationRequest $request)
    {
        return response()->json($this->goalEvaluationService->store($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(GoalEvaluation $goalEvaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GoalEvaluation $goalEvaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGoalEvaluationRequest $request, GoalEvaluation $goalEvaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GoalEvaluation $goalEvaluation)
    {
        //
    }
}
