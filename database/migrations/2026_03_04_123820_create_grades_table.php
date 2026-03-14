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
    Schema::create('grades', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });

    // الآن نربط جدول المستخدمين بجدول الصفوف بأمان
    Schema::table('users', function (Blueprint $table) {
        $table->foreign('grade_id')->references('id')->on('grades')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
