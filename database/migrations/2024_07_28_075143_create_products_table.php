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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_main_id')->nullable()->constrained('product_category_mains')->comment("ประเภทสินค้าหลัก");
            $table->foreignId('product_category_sub_id')->nullable()->constrained('product_category_subs')->comment("ประเภทสินค้ารอง");
            $table->string('code')->nullable()->comment("โค้ดสินค้า");
            $table->string('name')->nullable()->comment("ชื่อสินค้า");
            $table->string('description')->nullable()->comment("รายละเอียดสินค้า");
            $table->string('image')->nullable()->comment("รูปสินค้า");
            $table->decimal('cost',8,2)->nullable()->comment("ราคาต้นทุน");
            $table->decimal('price',8,2)->nullable()->comment("ราคาขาย");
            $table->integer('quantity')->nullable()->comment("จํานวนสินค้าคงเหลือ");
            $table->string('status')->nullable()->comment("สถานะ");
            $table->boolean('active')->default(true)->comment("สถานะการใช้งาน");
            $table->boolean('is_new')->default(false)->comment("สินค้าใหม่");
            $table->boolean('is_recommend')->default(false)->comment("สินค้าแนะนำ");
            $table->boolean('is_popular')->default(false)->comment("สินค้ายอดนิยม");
            $table->boolean('is_discount')->default(false)->comment("สินค้าส่วนลดราคา");
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
        Schema::dropIfExists('products');
    }
};
