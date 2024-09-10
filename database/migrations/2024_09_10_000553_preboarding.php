<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('preboarding_attendance', function (Blueprint $table) {
            $table->integer('app_id')->autoIncrement();
            $table->string('name');
            $table->string('email_address');
            $table->string('intern_type');
            $table->string('phone_number');
            $table->string('facebook_link');
            $table->string('course');
            $table->string('school_name');
            $table->string('school_contact');
            $table->string('hours_requirement');
            $table->string('discord_username');
            $table->date('orientation_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status');

            $table->primary('app_id');
        });

        // Set AUTO_INCREMENT to start at 7000
        DB::statement("ALTER TABLE preboarding_attendance AUTO_INCREMENT = 7000");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preboarding_attendance');
    }
};
