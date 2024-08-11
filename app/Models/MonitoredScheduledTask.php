<?php

namespace App\Models;

use App\Traits\ReadableCron;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\ScheduleMonitor\Models\MonitoredScheduledTask as BaseMonitoredScheduledTask;

class MonitoredScheduledTask extends BaseMonitoredScheduledTask
{
    use HasFactory, ReadableCron;

    public static $attributeLabels = [
        'name' => 'ชื่องานตามกำหนดเวลา',
        'type' => 'ประเภทงาน',
        'readableCron' => 'กำหนดเวลา',
        'last_started_at' => 'เริ่มทำงานล่าสุด',
        'last_finished_at' => 'สิ้นสุดงานล่าสุด',
        'last_failed_at' => 'ล้มเหลวล่าสุด',
        'last_skipped_at' => 'ข้ามงานล่าสุด',
    ];
}
