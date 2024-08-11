<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasFactory, SoftDeletes, BlameableTrait;

    protected $casts = [
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'deleted_by' => 'integer',
    ];

    public static $attributeLabels = [
        'name' => 'ชื่อหน้าที่ในระบบ',
        'guard_name' => 'ชื่อ guard',
        'active' => 'เปิดการใช้งาน',
        'created_by' => 'ผู้สร้าง',
        'updated_by' => 'ผู้แก้ไข',
        'deleted_by' => 'ผู้ลบ',
        'created_at' => 'วันที่สร้าง',
        'updated_at' => 'วันที่แก้ไขล่าสุด',
        'deleted_at' => 'วันที่ลบ',
        'permissions' => 'สิทธิการใช้งาน'
    ];

    public function craetedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function getSubjectLabel() {
        return $this->name;
    }
}
