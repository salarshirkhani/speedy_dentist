<?php

return [

    'mail_config' => [
        'MAIL_HOST' => env('MAIL_HOST'),
        'MAIL_PORT' => env('MAIL_PORT'),
        'MAIL_USERNAME' => env('MAIL_USERNAME'),
        'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
        'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
        'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
        'MAIL_FROM_NAME' => env('MAIL_FROM_NAME')
    ],

    'mail_key_map' => [
        'MAIL_HOST' => 'smtp_host',
        'MAIL_PORT' => 'smtp_port',
        'MAIL_USERNAME' => 'smtp_user',
        'MAIL_PASSWORD' => 'smtp_password',
        'MAIL_ENCRYPTION' => 'smtp_type',
        'MAIL_FROM_ADDRESS' => 'sender_email',
        'MAIL_FROM_NAME' => 'sender_name'
    ],

    'blood_groups' => [
        'A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'
    ],

    'weekdays' => [
        'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
    ],

    'avg_appointment_durations' => [
        5, 10, 15, 30, 45, 60
    ]

];
