<?php

namespace App\Mail;

use App\EmailCorn;
use App\EmailTpl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Transport\MailgunTransport;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{

    protected $emailTpl;
    protected $emailCorn;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EmailTpl $emailTpl,EmailCorn $emailCorn)
    {

        $this->emailTpl=$emailTpl;
        $this->emailCorn=$emailCorn;

        /*if ($address!=''){
            $this->from($address,$address_name);
        }*/

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

       if ($this->emailCorn->address){
            return    $this->from($this->emailCorn->address,$this->emailCorn->address_name)
               ->subject($this->emailCorn->name)->view('email',['desc'=>$this->emailTpl->desc]);
       }else{
           return  $this->subject($this->emailCorn->name)->view('email',['desc'=>$this->emailTpl->desc]);
       }

    }
    protected function formatDesc(){
        $filter=[
            '*|EMAIL|*',
            '*|LIST:ADDRESSLINE|*',
            '*|REWARDS|*',

        ];
    }
}
