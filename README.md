RabbitMQ Laravel connector example
======================

#### Info

Based on `vladimir-yuldashev/laravel-queue-rabbitmq` but
`php-amqplib/php-amqplib` dependency changed to `bunny/bunny`

#### Installation
1. Copy files / settings into project
2. Install RabbitMQ
3. Install dependency by `php composer.phar require bunny/bunny`
4. Add handler into queue by test command `./artisan add:queue`
5. Referrer to official Laravel queue documentation (https://laravel.com/docs/5.1/queues) how to consume tasks and supervise consumer process `./artisan queue:work rabbitmq`

#### Running example:

        root@1300d0f1ae84:/src/blog# ./artisan add:queue
        root@1300d0f1ae84:/src/blog# ./artisan queue:work rabbitmq
        [2016-04-05 11:02:52] Processed: IlluminateQueueClosure
        root@1300d0f1ae84:/src/blog# ./artisan queue:work rabbitmq
        [2016-04-05 11:02:53] Processed: IlluminateQueueClosure
        root@1300d0f1ae84:/src/blog# ./artisan queue:work rabbitmq
        [2016-04-05 11:02:54] Processed: IlluminateQueueClosure

#### Contributing

Feel free to help/advice

###License

The MIT License (MIT)
