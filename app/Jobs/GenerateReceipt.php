<?php

namespace App\Jobs;

use App\Payment;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Mail\PaymentSuccessful;
use LaravelDaily\Invoices\Invoice;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use LaravelDaily\Invoices\Classes\Party;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class GenerateReceipt implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
     public $payment;

    public function __construct(Payment $payment)
    {
        //
        $this->payment = $payment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        
        try {
            //code...
            $client = new Party([
                'fullname'       => $this->payment->sponsor->profile->firstname.' '.$this->payment->sponsor->profile->middlename.' '.$this->payment->sponsor->profile->lastname,
                'email'       => $this->payment->sponsor->email,
                'phone'       => $this->payment->sponsor->profile->phone,
            ]);
    
            $customer = new Party([
                'fullname'       => $this->payment->student->profile->firstname.' '.$this->payment->student->profile->middlename.' '.$this->payment->student->profile->lastname,   
                'email'       => $this->payment->student->email,   
                'phone'       => $this->payment->student->profile->phone,   
            ]);
    
            $TotalReceiptAmount = $this->payment->amount;
            $item =  (new InvoiceItem())->title($this->payment->student_name.Str::random(5))->subTotalPrice($TotalReceiptAmount);
            $notes = $this->payment->status;
    
            $invoice = Invoice::make('receipt')
                ->series('NOO')
                ->sequence(876)
                ->serialNumberFormat('{SEQUENCE}/{SERIES}')
                ->seller($client)
                ->buyer($customer)
                ->date($this->payment->created_at)
                ->dateFormat('m/d/Y')
                ->currencySymbol('$')
                ->currencyCode('USD')
                ->currencyFormat('{SYMBOL}{VALUE}')
                ->currencyThousandsSeparator(',')
                ->currencyDecimalPoint('.')
                ->filename($this->payment->student->username.'-'.Str::random(5).'-'.$this->payment->sponsor->username.'-'.Str::random(3))
                ->addItem($item)
                ->notes($notes)
                ->totalAmount($TotalReceiptAmount)
                // ->logo(public_path('vendor/invoices/sample-logo.png'))
                // You can additionally save generated invoice to configured disk
                ->save('s3');
                
            $link = $invoice->url();
            // Then send email to party with link
              $receipt = $this->payment->receipt()->create([
                  'url'=> $link,
              ]);
            //   $receipt::with('payments.sponsor.profile','payments.student.profile');
            //   $receipt->addMedia(storage_path().'\app\public\\'.$invoice->myCustomfilename())
            //  ->toMediaCollection('receipts');
    
             Mail::to($this->payment->sponsor->email)->send(new PaymentSuccessful($receipt));
        } catch (\Exception $th) {
            //throw $th;
            // Payment::destroy($this->payment->id);
        }
       

         
    }
}
