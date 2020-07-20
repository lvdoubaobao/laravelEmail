<?php

namespace App\Mail;

use App\EmailTpl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    protected $emailTpl;
    protected $address;
    protected $address_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EmailTpl $emailTpl,$address='',$address_name='')
    {

        $this->emailTpl=$emailTpl;
        $this->address=$address;
        $this->address_name=$address_name;
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
       if ($this->address){

            return    $this->from($this->address,$this->address_name)
               ->subject($this->emailTpl->name)->view('email',['desc'=>$this->emailTpl->desc]);
       }else{
           return  $this->subject($this->emailTpl->name)->view('email',['desc'=>$this->emailTpl->desc]);
       }

    }
}
