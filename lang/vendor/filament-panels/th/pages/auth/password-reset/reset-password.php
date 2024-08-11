<?php

return [

    'title' => 'รีเซ็ตรหัสผ่านของคุณ', // Reset your password (translated to Thai)

    'heading' => 'รีเซ็ตรหัสผ่านของคุณ', // Reset your password (translated to Thai)

    'form' => [

        'email' => [
            'label' => 'อีเมล', // Email address (translated to Thai)
        ],

        'password' => [
            'label' => 'รหัสผ่าน', // Password (translated to Thai)
            // 'validation_attribute' => 'password',
            'validation_attribute' => 'รหัสผ่าน',
        ],

        'password_confirmation' => [
            'label' => 'ยืนยันรหัสผ่าน', // Confirm password (translated to Thai)
        ],

        'actions' => [

            'reset' => [
                'label' => 'รีเซ็ตรหัสผ่าน', // Reset password (translated to Thai)
            ],

        ],

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'พยายามรีเซ็ตมากเกินไป', // Too many reset attempts (translated to Thai)
            'body' => 'กรุณาลองอีกครั้งใน :seconds วินาที', // Please try again in :seconds seconds. (translated to Thai)
        ],

    ],

];
