<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class Orders extends Model
{
    use HasFactory,SoftDeletes,BlameableTrait;

    public static $attributeLabels = [
        'order_code' => 'รหัส ออร์เดอร์',
        'order_date' => 'วันที่ออก ออร์เดอร์',
        'status' => 'สถานะ ออร์เดอร์',
        'type' => 'ประเภท ออร์เดอร์',
        'price_total' => 'ราคาทั้งหมด',
        'products' => 'รายการสินค้า',
        'active' => 'สถานะการใช้งาน',
        'created_by' => 'ผู้ออก ออร์เดอร์',
        'updated_by' => 'ผู้แก้ไข ออร์เดอร์',
        'deleted_by' => 'ผู้ลบ ออร์เดอร์',
        'created_at' => 'เวลาออก ออร์เดอร์',
        'updated_at' => 'เวลาแก้ไข ออร์เดอร์',
        'deleted_at' => 'เวลาลบ ออร์เดอร์',
    ];

    protected function casts(): array 
    {
        return [
            'products' => 'array',
        ];
    }
}
