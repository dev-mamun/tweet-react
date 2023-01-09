<?php

namespace App\Listeners;

use App\Events\TweetCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\User;
use App\Notifications\NewTweet;


class SendTweetCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TweetCreated  $event
     * @return void
     */
    public function handle(TweetCreated $event)
    {
        foreach (User::whereNot('id', $event->tweet->user_id)->cursor() as $user) {
            $user->notify(new NewTweet($event->tweet));
        }
    }
}
