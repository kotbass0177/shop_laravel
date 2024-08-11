<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\ScheduleMonitor\Models\MonitoredScheduledTaskLogItem as BaseMonitoredScheduledTaskLogItem;

class MonitoredScheduledTaskLogItem extends BaseMonitoredScheduledTaskLogItem
{
    use HasFactory;

    public static $attributeLabels = [
        'type' => 'ประเภทการทำงาน',
        'memory' => 'หน่วยความจำ',
        'runtime' => 'ระยะเวลาทำงาน',
        'created_at' => 'วันที่ทำงาน',
    ];
}
