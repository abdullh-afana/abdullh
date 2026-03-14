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
    Schema::table('exams', function (Blueprint $table) {
        // جعل الحقول التي تسبب مشاكل اختيارية (Nullable) أو حذفها
        if (Schema::hasColumn('exams', 'type')) {
            $table->string('type')->nullable()->change(); 
        }
        if (Schema::hasColumn('exams', 'attempts')) {
            $table->integer('attempts')->nullable()->change();
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            //
        });
    }
};
