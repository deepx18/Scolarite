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
        Schema::table('students', function (Blueprint $table) {
            $table->string('cin')->unique()->nullable()->after('cne');
            $table->string('birth_city')->nullable()->after('date_of_birth');
            $table->string('nationality')->nullable()->after('birth_city');
            $table->string('gender')->nullable()->after('nationality');
            $table->string('study_level')->nullable()->after('gender');
            $table->string('specialization')->nullable()->after('study_level');
            $table->string('bac_year')->nullable()->after('specialization');
            $table->string('province')->nullable()->after('bac_year');
            $table->string('academic_track')->nullable()->after('province');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'cin',
                'birth_city',
                'nationality',
                'gender',
                'study_level',
                'specialization',
                'bac_year',
                'province',
                'academic_track',
            ]);
        });
    }
};
