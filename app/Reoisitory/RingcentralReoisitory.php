<?php


namespace App\Reoisitory;

use App\PhoneLog;
use App\PhoneTpl;
use App\User;
use RingCentral\SDK\SDK;
class RingcentralReoisitory
{
    protected $rcsdk;
    protected $platform;
    public function __construct()
    {
          $this->rcsdk= new SDK(
              config('ringcentral.RINGCENTRAL_CLIENTID'),
              config('ringcentral.RINGCENTRAL_CLIENTSECRET'),
              config('ringcentral.RINGCENTRAL_SERVER')
          );

        $this->platform = $this->rcsdk->platform();
        $this->platform->login( config('ringcentral.RINGCENTRAL_USERNAME'), config('ringcentral.RINGCENTRAL_EXTENSION'),config('ringcentral.RINGCENTRAL_PASSWORD'));
    }
    public function sendSms(User $user,PhoneTpl $phoneTpl){

        $text=str_replace('{{name}}',$user->name,$phoneTpl->tpl);

        $phoneLog=new PhoneLog();
     // $resp=  $this->platform->get('/account/~/extension/~/phone-number');
    //  return $resp->jsonArray();
        try{
            $resp = $this->platform->post('/account/~/extension/~/sms',
                array(
                    'from' => array ('phoneNumber' =>  config('ringcentral.RINGCENTRAL_USERNAME')),
               //     'to' => array(array('phoneNumber' => $user->phone)),
                    'to' => array(array('phoneNumber' =>'+12095793478')),
                    'text' => $text
                ));
                $phoneLog->message=json_encode($resp->jsonArray());
                $phoneLog->phone=$user->phone;
                $phoneLog->status=1;
                $phoneLog->save();
        }catch (\Exception $exception){
            $phoneLog->phone=$user->phone;
            $phoneLog->status=0;
            $phoneLog->reason=$exception->getMessage();
            $phoneLog->save();

        }



    }
}
