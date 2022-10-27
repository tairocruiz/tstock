<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\Tour;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnquireSafari extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $tour, $data;

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
        return $this
            ->from($this->data['email'])
            ->subject('Re: Safari Enquiry for '.$this->tour->name)
            ->view('front.mails.enquire');
    }
}
