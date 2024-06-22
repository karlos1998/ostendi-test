<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(EmployeeSeeder::class);
        $this->call(GoalSeeder::class);

        $userBearer = $user->createToken('seed')->plainTextToken;

        echo "Bearer Administratora: $userBearer";

    }
}
