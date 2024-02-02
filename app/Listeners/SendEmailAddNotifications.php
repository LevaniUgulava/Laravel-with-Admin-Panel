<?php

namespace App\Listeners;

use App\Events\AddProduct;
use App\Mail\Added;
use Illuminate\Support\Facades\Mail;

class SendEmailAddNotifications
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AddProduct $event): void
    {

        Mail::to('levani.ugulava04@gmail.com')->send(new Added($event));

    }
}
