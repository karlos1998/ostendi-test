<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GoalEvaluationsApiTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->userToken = $this->user->createToken('test')->plainTextToken;
    }

    public function test_login_required(): void
    {
        $response = $this->postJson(route('goal-evaluations.store'));

        $response->assertUnauthorized();
    }

    public function test_create_goal(): void
    {
        $response = $this->withToken($this->userToken)->postJson(route('goal-evaluations.store'), [
            'goal_id' => Goal::factory()->create()->id,
            'employee_id' => Employee::factory()->create()->id,
            'progress' => 10,
        ]);

        $response->assertOk();
    }

    public function test_create_goal_evaluation_with_valid_data(): void
    {
        $goal = Goal::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->withToken($this->userToken)->postJson(route('goal-evaluations.store'), [
            'goal_id' => $goal->id,
            'employee_id' => $employee->id,
            'progress' => 10,
        ]);

        $response->assertJsonStructure([
            'id',
            'employee' => [
                'id',
                'first_name',
                'last_name',
            ],
            'goal' => [
                'id',
                'name',
            ],
            'progress',
        ]);
    }

    public function test_create_goal_evaluation_with_valid_data_and_check_content(): void
    {
        $goal = Goal::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->withToken($this->userToken)->postJson(route('goal-evaluations.store'), [
            'goal_id' => $goal->id,
            'employee_id' => $employee->id,
            'progress' => 10,
        ]);

        $response->assertJson([
            'employee' => [
                'id' => $employee->id,
                'first_name' => $employee->first_name,
                'last_name' => $employee->last_name,
            ],
            'goal' => [
                'id' => $goal->id,
                'name' => $goal->name,
            ],
            'progress' => 10,
        ]);
    }

    public function test_create_goal_evaluation_with_missing_goal_id(): void
    {
        $employee = Employee::factory()->create();

        $response = $this->withToken($this->userToken)->postJson(route('goal-evaluations.store'), [
            'employee_id' => $employee->id,
            'progress' => 10,
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['goal_id']);
    }

    public function test_create_goal_evaluation_with_missing_employee_id(): void
    {
        $goal = Goal::factory()->create();

        $response = $this->withToken($this->userToken)->postJson(route('goal-evaluations.store'), [
            'goal_id' => $goal->id,
            'progress' => 10,
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['employee_id']);
    }

    public function test_create_goal_evaluation_with_missing_progress(): void
    {
        $goal = Goal::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->withToken($this->userToken)->postJson(route('goal-evaluations.store'), [
            'goal_id' => $goal->id,
            'employee_id' => $employee->id,
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['progress']);
    }

    public function test_create_goal_evaluation_with_invalid_progress_value(): void
    {
        $goal = Goal::factory()->create();
        $employee = Employee::factory()->create();

        $response = $this->withToken($this->userToken)->postJson(route('goal-evaluations.store'), [
            'goal_id' => $goal->id,
            'employee_id' => $employee->id,
            'progress' => 'invalid',
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['progress']);
    }

    public function test_create_goal_evaluation_with_progress_out_of_range(): void
    {
        $goal = Goal::factory()->create();
        $employee = Employee::factory()->create();

        // Test progress below 0
        $response = $this->withToken($this->userToken)->postJson(route('goal-evaluations.store'), [
            'goal_id' => $goal->id,
            'employee_id' => $employee->id,
            'progress' => -1,
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['progress']);

        // Test progress above 100
        $response = $this->withToken($this->userToken)->postJson(route('goal-evaluations.store'), [
            'goal_id' => $goal->id,
            'employee_id' => $employee->id,
            'progress' => 101,
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['progress']);
    }

    public function test_create_goal_evaluation_with_non_existent_goal_id(): void
    {
        $employee = Employee::factory()->create();

        $response = $this->withToken($this->userToken)->postJson(route('goal-evaluations.store'), [
            'goal_id' => 999,
            'employee_id' => $employee->id,
            'progress' => 10,
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['goal_id']);
    }

    public function test_create_goal_evaluation_with_non_existent_employee_id(): void
    {
        $goal = Goal::factory()->create();

        $response = $this->withToken($this->userToken)->postJson(route('goal-evaluations.store'), [
            'goal_id' => $goal->id,
            'employee_id' => 999,
            'progress' => 10,
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['employee_id']);
    }
}
