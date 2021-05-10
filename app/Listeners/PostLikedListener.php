<?php

namespace App\Listeners;


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class PostLikedListener
{
    private $channel;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $connection = new AMQPStreamConnection('172.18.0.1', 5672, 'guest', 'guest');
        $this->channel = $connection->channel();
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $message = new AMQPMessage(json_encode([
            'message_type' => 'like_post',
            'post_id' => $event->postId,
            'user_name' => $event->userName
        ]));

        $this->channel->basic_publish($message, null, 'nodejs');
    }
}
