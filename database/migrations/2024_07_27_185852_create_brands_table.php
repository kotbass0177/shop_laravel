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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->comment('โค้ดแบรนด์');
            $table->string('name')->nullable()->comment('ชื่อแบรนด์');
            $table->string('description')->nullable()->comment('รายละเอียดแบรนด์');
            $table->string('image')->nullable()->comment('รูปภาพแบรนด์');
            $table->boolean('active')->nullable()->comment('สถานะการใช้งาน');
            $table->foreignId('created_by')->nullable()->constrained('users')->comment('ผู้สร้าง');
            $table->foreignId('updated_by')->nullable()->constrained('users')->comment('ผู้แก้ไข');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->comment('ผู้ลบ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
