<?php

use App\Models\Set;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->foreignIdFor(Set::class)->nullable();
            $table->integer('number_of_attempts');
            $table->integer('duration_minutes'); // Duration of the test in minutes
            $table->dateTimeTz('validity_start_time')->nullable();
            $table->dateTimeTz('validity_end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
