<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Laravel\Pennant\Concerns\HasFeatures;
use Laravel\Sanctum\HasApiTokens;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasRoles
        , HasPanelShield, BlameableTrait, SoftDeletes, HasApiTokens
        , HasFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static $attributeLabels = [
        'username' => 'ชื่อผู้ใช้งาน',
        'name' => 'ชื่อ-นามสกุล',
        'mobile_no' => 'โทรศัพท์มือถือ',
        'mobile_no_verified_at' => 'วันที่ยืนยันโทรศัพท์มือถือ',
        'jobTitle' => 'ตำแหน่งงาน',
        'email' => 'อีเมล',
        'email_verified_at' => 'วันที่ยืนยันอีเมล',
        'password' => 'รหัสผ่าน',
        'confirmPassword' => 'ยืนยันรหัสผ่าน',
        'roles' => 'หน้าที่ในระบบ',
        'active' => 'เปิดการใช้งาน',
        'created_by' => 'ผู้สร้าง',
        'updated_by' => 'ผู้แก้ไข',
        'deleted_by' => 'ผู้ลบ',
        'created_at' => 'วันที่สร้าง',
        'updated_at' => 'วันที่แก้ไขล่าสุด',
        'deleted_at' => 'วันที่ลบ',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

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

    public function jobTitle(): BelongsTo
    {
        return $this->belongsTo(JobTitle::class, 'job_title_id');
    }

    public function getFilamentAvatarUrl(): ?string
    {
        if (config('filament.default_filesystem_disk') === 's3') {
            return $this->avatar_url ? Storage::temporaryUrl(
                $this->avatar_url,
                now()->addMinutes(5)
            ) : null;
        }
        return $this->avatar_url ? Storage::url($this->avatar_url) : null;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getSubjectLabel() {
        return $this->name;
    }

    protected function roleNames(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getRoleNames(),
        );
    }

}
