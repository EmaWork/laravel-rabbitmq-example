<?php

return [

    // ... other settings ...

    'connections' => [

       // ... other connections ...

        'rabbitmq' => [

            'driver' => 'rabbitmq',

            'host' => env('RABBITMQ_SETTING_HOST', 'rabbitmq'),
            'port' => env('RABBITMQ_SETTING_PORT', 5672),

            'vhost' => env('RABBITMQ_SETTING_VHOST', '/'),
            'login' => env('RABBITMQ_SETTING_LOGIN', 'guest'),
            'password' => env('RABBITMQ_SETTING_PASSWORD', 'guest'),

            'queue' => env('RABBITMQ_SETTING_QUEUE', 'default'), // name of the default queue,

            'exchange_declare' => env('RABBITMQ_SETTING_EXCHANGE_DECLARE', true), // create the exchange if not exists
            // create the queue if not exists and bind to the exchange
            'queue_declare_bind' => env('RABBITMQ_SETTING_QUEUE_DECLARE_BIND', true),

            'queue_params' => [
                'passive' => env('RABBITMQ_SETTING_QUEUE_PASSIVE', false),
                'durable' => env('RABBITMQ_SETTING_QUEUE_DURABLE', true),
                'exclusive' => env('RABBITMQ_SETTING_QUEUE_EXCLUSIVE', false),
                'auto_delete' => env('RABBITMQ_SETTING_QUEUE_AUTODELETE', false),
            ],
            'exchange_params' => [
                'name' => env('RABBITMQ_SETTING_EXCHANGE_NAME', null),
                // http://www.rabbitmq.com/tutorials/amqp-concepts.html
                'type' => env('RABBITMQ_SETTING_EXCHANGE_TYPE', 'direct'),
                'passive' => env('RABBITMQ_SETTING_EXCHANGE_PASSIVE', false),
                // the exchange will survive server restarts
                'durable' => env('RABBITMQ_SETTING_EXCHANGE_DURABLE', true),
                'auto_delete' => env('RABBITMQ_SETTING_EXCHANGE_AUTODELETE', false),
            ],

        ]

    ],

	// ... other settings ...

];
