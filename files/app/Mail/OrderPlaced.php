<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ali_omurov@mail.ru', 'Администратор сайта eco-life.kg')
            ->to('ali_omurov@mail.ru', 'Администратор сайта')
            ->subject('Новый заказ с сайта Eco-life.kg!')
            ->view('emails.orders.placed');
    }
}
