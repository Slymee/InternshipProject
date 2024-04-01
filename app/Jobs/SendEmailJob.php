<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $orderInfo;

    /**
     * Create a new job instance.
     */
    public function __construct($userDetails, array $orderInfo)
    {
        $this->user = $userDetails->name;
        $this->orderInfo = $orderInfo;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = $this->user;
        $orderInfo = $this->orderInfo;
        $nameOfUser = $this->user->name;
        $productName = Product::find($this->orderInfo['product_id'])->product_title;
        Mail::send('userend.commonComponents.purchase-receipt-email', compact('nameOfUser', 'productName', 'orderInfo'), function($message) use ($user) {
        $message->to($user->email);
        $message->subject('Purchase Receipt');
    });
    }
}
