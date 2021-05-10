<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class PostLiked
{
    use Dispatchable;

    public $postId;
    public $userName;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($postId, $userName)
    {
        $this->postId = $postId;
        $this->userName = $userName;
    }
}
