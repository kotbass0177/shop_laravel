<?php

return [

    'title' => 'ยืนยันอีเมลของคุณ', // Verify your email address (translated to Thai)

    'heading' => 'ยืนยันอีเมลของคุณ', // Verify your email address (translated to Thai)

    'actions' => [

        'resend_notification' => [
            'label' => 'ส่งอีกครั้ง', // Resend it (translated to Thai)
        ],

    ],

    'messages' => [
        'notification_not_received' => 'ยังไม่ได้รับอีเมลที่เราส่ง?', // Not received the email we sent? (translated to Thai)
        'notification_sent' => 'เราได้ส่งอีเมลไปที่ :email เพื่อแจ้งคำแนะนำเกี่ยวกับวิธีการยืนยันอีเมลของคุณ', // We've sent an email to :email containing instructions on how to verify your email address. (translated to Thai)
    ],

    'notifications' => [

        'notification_resent' => [
            'title' => 'เราได้ส่งอีเมลไปอีกครั้ง', // We've resent the email. (translated to Thai)
        ],

        'notification_resend_throttled' => [
            'title' => 'ส่งอีเมลยืนยันซ้ำหลายครั้งเกินไป', // Too many resend attempts (translated to Thai)
            'body' => 'กรุณาลองอีกครั้งใน :seconds วินาที', // Please try again in :seconds seconds. (translated to Thai)
        ],

    ],

];
