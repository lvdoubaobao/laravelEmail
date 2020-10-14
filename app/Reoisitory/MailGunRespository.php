<?php


namespace App\Reoisitory;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Mailgun\Mailgun;

class MailGunRespository
{
    protected $mailgun_key;
    protected $mailgun_domian;
    protected $mailgun_from_address;
    protected $mailgun_from_name;
    protected $tag = [];
    protected $mailgun_to;

    public function __construct()
    {
        $this->mailgun_key = config('services.mailgun.secret');
        $this->mailgun_domian = config('services.mailgun.domain');
        $this->mailgun_from_address = config('mail.from.address');
        $this->mailgun_from_name = config('mail.from.name');
        $this->tag = [Carbon::today()->toDateString()];
    }

    public function send($subject, $desc)
    {
        $mailgun = Mailgun::create($this->mailgun_key);
        $mailgun_from = $this->mailgun_from_name . " <" . $this->mailgun_from_address . ">";
        $params = [
            'from' => $mailgun_from,
         //   'to' => 'q736400469@gmail.com',
              'to' => $this->mailgun_to ,
            'subject' => $subject,
            'html' => $desc,
            'o:tag' => $this->tag
        ];
        try {
            $result = $mailgun->messages()->send($this->mailgun_domian, $params);
            Log::channel('email_success')->info($this->mailgun_to . ':' . $subject . ':发送成功');
        } catch (\Mailgun\Exception\HttpClientException $exception) {
            Log::channel('email_error')->error($this->mailgun_to . ':' . $subject . ':发送失败', ['exception' => $exception->getMessage()]);
        }
    }

    public function from($name)
    {
        $this->mailgun_from_name = $name;
        return $this;
    }

    public function to($to)
    {
        $this->mailgun_to = $to;
        return $this;
    }

    public function formName($address)
    {
        $this->mailgun_from_address = $address;
        return $this;
    }

    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }
}
