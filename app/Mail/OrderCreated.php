<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

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
        return $this->from(config('tpay.tpay_email'))
            ->markdown('mails.order_created')
            ->with([
                'order' => $this->order,
                'products' => $this->order->products
            ])
            ->subject('Nowe zamówienie o numerze: ' . $this->order->number . '!');
    }
}
