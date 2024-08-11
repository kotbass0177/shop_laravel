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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('job_title_id')->nullable()->constrained('job_titles');
            $table->string('mobile_no')->index()->nullable()->after('email_verified_at');
            $table->timestamp('mobile_no_verified_at')->nullable()->after('mobile_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('mobile_no_verified_at');
            $table->dropColumn('mobile_no');
            $table->dropColumn('job_title_id');
        });
    }
};
