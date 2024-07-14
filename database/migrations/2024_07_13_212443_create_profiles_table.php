<?php

use App\Models\C3;
use App\Models\Center;
use App\Models\ServiceTeam;
use App\Models\User;
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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('title')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('occupation')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'separated'])->nullable();
            $table->text('address')->nullable();
            $table->foreignIdFor(Center::class)->nullable();
            $table->foreignIdFor(C3::class)->nullable();
            $table->foreignIdFor(ServiceTeam::class)->nullable();
            $table->boolean('gone_through_growth_track')->nullable();
            $table->string('growth_track_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
