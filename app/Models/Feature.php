<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Pennant\Feature as PennantFeature;
use Stephenjude\FilamentFeatureFlag\Models\FeatureSegment;
use Sushi\Sushi;

class Feature extends Model
{
    use HasFactory, Sushi;

    public static $attributeLabels = [
        'name' => 'ชื่อ Feature',
        'is_activated' => 'เปิดใช้งาน',
        'featureSegments' => 'เงื่อนไขสําหรับผู้ใช้งาน',
        'values' => 'ค่าที่ต้องการ',
        'status' => 'สถานะ',
        'ACTIVATED' => 'เปิดใช้งาน',
        'DEACTIVATED' => 'ปิดใช้งาน',
    ];

    protected $schema = [
        'key' => 'string',
        'name' => 'string',
        'is_activated' => 'boolean',
    ];

    public function getRows()
    {
        $res = collect(PennantFeature::all())
            ->map(fn ($value, $key) => [
                'key' => $key,
                'name' => $name = str(class_basename($key))->snake()->replace('_', ' ')->title()->toString(),
                'is_activated' => $value,
            ])
            ->values()
            ->toArray();
        return $res;
    }

    public function featureSegments(): HasMany
    {
        return $this->hasMany(FeatureSegment::class, 'feature', 'key');
    }

    public function activate()
    {
        PennantFeature::activate($this->key);
    }

    public function deactivate()
    {
        PennantFeature::deactivate($this->key);
    }

    public static function getStatusColor($status)
    {
        return $status ? 'success' : 'danger';
    }

    public static function getStatusLabel($status)
    {
        return $status ? self::$attributeLabels['ACTIVATED'] : self::$attributeLabels['DEACTIVATED'];
    }
}
