<?php

use App\Models\Assessment;
use App\Models\User;
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
        Schema::create('attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Assessment::class);
            $table->integer('attempt_number'); // 1, 2, or 3
            $table->dateTime('started_at');
            $table->dateTime('ended_at')->nullable();
            $table->string('correctly_answered')->nullable();
            $table->string('total_number_of_questions')->nullable();
            $table->string('percentage_score')->nullable();
            $table->boolean('is_submitted')->nullable()->default(false); // Attempted chosen for fina submission
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attempts');
    }
};
