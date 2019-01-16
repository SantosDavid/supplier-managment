<?php

namespace App\Jobs;

use Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Company\Supplier;
use App\Mail\ActiveSupplier as Email;
use App\Models\Company\ActiveSupplier;

class SendEmailSupplier implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    
    public $activation;

    public function __construct(ActiveSupplier $activation)
    {
        $this->activation = $activation;
    }

    public function handle()
    {
        Mail::to($this->activation->supplier->email)
            ->send(new Email($this->activation));
    }
}
