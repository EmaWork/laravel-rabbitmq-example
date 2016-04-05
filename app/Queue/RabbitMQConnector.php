<?php
namespace App\Queue;

use Illuminate\Queue\Connectors\ConnectorInterface;
use Bunny\Client;

class RabbitMQConnector implements ConnectorInterface
{

    /**
     * Establish a queue connection.
     *
     * @param  array $config
     *
     * @return \Illuminate\Contracts\Queue\Queue
     */
    public function connect(array $config)
    {
        $client = new Client([
            "host" => $config['host'],
            "port" => $config['port'],
            "vhost" => $config['vhost'],
            "user" => $config['login'],
            "password" => $config['password'],
        ]);

        return new RabbitMQQueue(
            $client,
            $config
        );
    }
}
