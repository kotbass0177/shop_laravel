<?php

return [

    'title' => 'ลงทะเบียน', // Register (translated to Thai)

    'heading' => 'สมัครสมาชิก', // Sign up (translated to Thai)

    'actions' => [

        'login' => [
            'before' => 'หรือ', // or (translated to Thai)
            'label' => 'เข้าสู่ระบบ', // sign in to your account (translated to Thai)
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'อีเมล', // Email address (translated to Thai)
        ],

        'name' => [
            'label' => 'ชื่อ', // Name (translated to Thai)
        ],

        'password' => [
            'label' => 'รหัสผ่าน', // Password (translated to Thai)
            'validation_attribute' => 'password',
        ],

        'password_confirmation' => [
            'label' => 'ยืนยันรหัสผ่าน', // Confirm password (translated to Thai)
        ],

        'actions' => [

            'register' => [
                'label' => 'สมัครสมาชิก', // Sign up (translated to Thai)
            ],

        ],

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'พยายามสมัครสมาชิกมากเกินไป', // Too many registration attempts (translated to Thai)
            'body' => 'กรุณาลองอีกครั้งใน :seconds วินาที', // Please try again in :seconds seconds. (translated to Thai)
        ],

    ],

];
