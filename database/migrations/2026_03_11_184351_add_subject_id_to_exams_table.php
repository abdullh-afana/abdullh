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
        // إضافة العمود وربطه بجدول المواد
        $table->foreignId('subject_id')->after('title')->constrained()->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('exams', function (Blueprint $table) {
        $table->dropForeign(['subject_id']);
        $table->dropColumn('subject_id');
    });
}
};
