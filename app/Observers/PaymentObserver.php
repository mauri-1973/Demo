<?php
 
namespace App\Observers;
 
use App\Payment;
use Uuid;
 
class PaymentObserver
{
    public function creating(Payment $payment)
    {
    	$payment->uuid = Uuid::generate()->string;
    }
}
