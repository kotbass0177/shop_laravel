<?php

return [

    'title' => 'เข้าสู่ระบบ', // Login (translated to Thai)

    'heading' => 'ลงชื่อเข้าใช้', // Sign in (translated to Thai)

    'actions' => [

        'register' => [
            'before' => 'หรือ', // or (translated to Thai)
            'label' => 'สมัครสมาชิก', // sign up for an account (translated to Thai)
        ],

        'request_password_reset' => [
            'label' => 'ลืมรหัสผ่าน?', // Forgotten your password? (translated to Thai)
        ],

    ],

    'form' => [

        'email' => [
            'label' => 'อีเมล', // Email address (translated to Thai)
        ],

        'password' => [
            'label' => 'รหัสผ่าน', // Password (translated to Thai)
        ],

        'remember' => [
            'label' => 'จดจำฉัน', // Remember me (translated to Thai)
        ],

        'actions' => [

            'authenticate' => [
                'label' => 'ลงชื่อเข้าใช้', // Sign in (translated to Thai)
            ],

        ],

    ],

    'messages' => [

        'failed' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง', // These credentials do not match our records. (translated to Thai)

    ],

    'notifications' => [

        'throttled' => [
            'title' => 'พยายามเข้าสู่ระบบมากเกินไป', // Too many login attempts (translated to Thai)
            'body' => 'กรุณาลองอีกครั้งใน :seconds วินาที', // Please try again in :seconds seconds. (translated to Thai)
        ],

    ],

];
