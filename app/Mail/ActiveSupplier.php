<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Company\ActiveSupplier as Activation;

class ActiveSupplier extends Mailable
{
    use Queueable, SerializesModels;

    protected $activation;

    public function __construct(Activation $activation)
    {
        $this->activation = $activation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->with(['activation' => $this->activation])
            ->view('emails.suppliers.activation');
    }
}
