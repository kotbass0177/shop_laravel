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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->nullable()->index()->comment("รหัสออเดอร์");
            $table->dateTime('order_date')->nullable()->comment('วันที่ออกออเดอร์');
            $table->string('status')->notnull()->default('pending')->comment("สถานะออเดอร์");
            $table->string('type')->nullable()->comment("ประเภทออเดอร์");
            $table->float('price_total')->nullable()->comment("ราคาทั้งหมด");
            $table->float('change_amount')->nullable()->comment("เงินทอน");
            $table->float('payment_type')->nullable()->comment("รับเงินสดหรือโอน");
            $table->json('products')->nullable()->comment("รายการสินค้า");
            $table->boolean('active')->nullable()->comment("สถานะการใช้งาน");
            $table->foreignId('created_by')->nullable()->constrained('users')->comment('ผู้ออกออเดอร์');
            $table->foreignId('updated_by')->nullable()->constrained('users')->comment('ผู้แก้ไขออเดอร์');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->comment('ผู้ลบออเดอร์');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
