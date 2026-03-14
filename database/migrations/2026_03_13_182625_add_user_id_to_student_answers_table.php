<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('student_answers', function (Blueprint $table) {
        // إضافة العمود فقط في حال لم يكن موجوداً
        if (!Schema::hasColumn('student_answers', 'user_id')) {
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
        }
    });
}

public function down()
{
    Schema::table('student_answers', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}
};
