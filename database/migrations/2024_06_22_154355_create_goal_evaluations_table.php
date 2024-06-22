<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('goal_evaluations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('progress')->default(0);

            $table->foreignIdFor(\App\Models\Goal::class)->nullable()->constrained();
            $table->foreignIdFor(\App\Models\Employee::class)->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goal_evaluations');
    }
};
