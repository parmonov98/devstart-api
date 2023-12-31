<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        Schema::create('developer_skills_pivot', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('skill_id')->constrained('skills');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists('developer_skills_pivot');
    }
};
