<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class Product extends Model
{
    use HasFactory, SoftDeletes, BlameableTrait;

    public static $attributeLabels = [
        'product_category_main_id' => 'ประเภทสินค้าหลัก',
        'product_category_sub_id' => 'ประเภทสินค้ารอง',
        'code' => 'โค้ดสินค้า',
        'name' => 'ชื่อสินค้า',
        'description' => 'รายละเอียดสินค้า',
        'image' => 'รูปสินค้า',
        'cost' => 'ราคาต้นทุน',
        'price' => 'ราคาขาย',
        'quantity' => 'จํานวนสินค้าคงเหลือ',
        'status' => 'สถานะ',
        'active' => 'สถานะการใช้งาน',
        'is_new' => 'สินค้าใหม่',
        'is_recommend' => 'สินค้าแนะนำ',
        'is_popular' => 'สินค้ายอดนิยม',
        'is_discount' => 'สินค้าส่วนลดราคา',
        'remark' => 'หมายเหตุ',
        'created_by' => 'ผู้สร้าง',
        'updated_by' => 'ผู้แก้ไข',
        'deleted_by' => 'ผู้ลบ',
    ];


    public function productCategoryMain():BelongsTo
    {
        return $this->belongsTo(ProductCategoryMain::class, 'product_category_main_id');
    }

    public function productCategorySub():BelongsTo
    {
        return $this->belongsTo(ProductCategorySub::class, 'product_category_sub_id');
    }
}
