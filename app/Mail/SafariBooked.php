<?php

namespace App\Mail;

use App\Models\Tour;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SafariBooked extends Mailable
{
    use Queueable, SerializesModels;

    public $tour;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Tour $tour, $data)
    {
        $this->tour = $tour;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // return $this->view('view.name');
       return $this
            ->from($this->data['email'])
            ->subject('Re: Booking for '.$this->tour->name)
            ->view('front.mails.booking');
    }
}
