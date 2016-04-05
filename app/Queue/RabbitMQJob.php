<?php
namespace App\Queue;

use Bunny\Channel;
use Bunny\Message;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\Job as JobContract;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\Jobs\Job;

class RabbitMQJob extends Job implements JobContract, ShouldQueue
{

    protected $connection;
    protected $channel;
    protected $queue;
    protected $message;

    public function __construct(
        Container $container,
        RabbitMQQueue $connection,
        Channel $channel,
        $queue,
        Message $message
    ) {
        $this->container = $container;
        $this->connection = $connection;
        $this->channel = $channel;
        $this->queue = $queue;
        $this->message = $message;
    }

    /**
     * Fire the job.
     *
     * @return void
     */
    public function fire()
    {
        $this->resolveAndFire(json_decode($this->message->content, true));
    }

    /**
     * Get the raw body string for the job.
     *
     * @return string
     */
    public function getRawBody()
    {
        return $this->message->content;
    }

    /**
     * Delete the job from the queue.
     *
     * @return void
     */
    public function delete()
    {
        parent::delete();

        $this->channel->ack($this->message);
    }

    /**
     * Get queue name
     *
     * @return string
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * Release the job back into the queue.
     *
     * @param  int $delay
     *
     * @return void
     */
    public function release($delay = 0)
    {
        $this->delete();

        $body = $this->message->content;
        $body = json_decode($body, true);

        $attempts = $this->attempts();

        // write attempts to body
        $body['data']['attempts'] = $attempts + 1;

        $job = $body['job'];
        $data = $body['data'];

        if ($delay > 0) {
            $this->connection->later($delay, $job, $data, $this->getQueue());
        } else {
            $this->connection->push($job, $data, $this->getQueue());
        }
    }

    /**
     * Get the number of times the job has been attempted.
     *
     * @return int
     */
    public function attempts()
    {
        $body = json_decode($this->message->content, true);

        return isset($body['data']['attempts']) ? (int)$body['data']['attempts'] : 0;
    }
}
