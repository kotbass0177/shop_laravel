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
        Schema::create('product_category_mains', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->comment("โค้ดประเภทสินค้าหลัก");
            $table->string('name')->nullable()->comment("ชื่อประเภทสินค้าหลัก");
            $table->string('description')->nullable()->comment("รายละเอียดประเภทสินค้าหลัก");
            $table->string('image')->nullable()->comment("รูปประเภทสินค้าหลัก");
            $table->string('status')->nullable()->comment("สถานะ");
            $table->boolean('active')->default(true)->comment("สถานะการใช้งาน");
            $table->string('remark')->nullable()->comment("หมายเหตุ");
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
        Schema::dropIfExists('product_category_mains');
    }
};
