<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class ProductCategorySub extends Model
{
    use HasFactory, SoftDeletes, BlameableTrait;

    public static $attributeLabels = [
        'product_category_main_id' => 'ประเภทสินค้าหลัก',
        'code' => 'โค้ดประเภทสินค้ารอง',
        'name' => 'ชื่อประเภทสินค้ารอง',
        'description' => 'รายละเอียดประเภทสินค้ารอง',
        'image' => 'รูปประเภทสินค้ารอง',
        'status' => 'สถานะ',
        'active' => 'สถานะการใช้งาน',
        'remark' => 'หมายเหตุ',
        'created_by' => 'ผู้สร้าง',
        'updated_by' => 'ผู้แก้ไข',
        'deleted_by' => 'ผู้ลบ',
    ];


    public function productCategoryMain(): BelongsTo
    {
        return $this->belongsTo(ProductCategoryMain::class, 'product_category_main_id');
    }
}
