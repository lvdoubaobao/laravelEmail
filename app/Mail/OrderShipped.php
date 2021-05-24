<?php

namespace App\Mail;

use App\EmailCorn;
use App\EmailTpl;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Message;
use Illuminate\Mail\Transport\MailgunTransport;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{

    protected $emailTpl;
    protected $emailCorn;
    protected  $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EmailTpl $emailTpl,EmailCorn $emailCorn,User  $user)
    {

        $this->emailTpl=$emailTpl;
        $this->emailCorn=$emailCorn;
        $this->user=$user;
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
   //     dd($this->emailCorn->address);

       if ($this->emailCorn->address){
            return    $this->from($this->emailCorn->address,$this->emailCorn->address_name)
               ->subject($this->emailCorn->name)->view('email',['desc'=>$this->emailTpl->desc,'user_address'=>$this->user->email,'user_name'=>$this->user->name]);
       }else{
           return  $this->subject($this->emailCorn->name)->view('email',['desc'=>$this->emailTpl->desc,'user_address'=>$this->user->email,'user_name'=>$this->user->name]);
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
