<?php


namespace App\Reoisitory;

use App\PhoneLog;
use App\PhoneTpl;
use App\RingCenter;
use App\User;
use RingCentral\SDK\SDK;
class RingcentralReoisitory
{
    protected $rcsdk;
    protected $platform;
    protected $ringcenter;
    public function __construct(RingCenter $ringcenter)
    {
          $this->ringcenter=$ringcenter;
          $this->rcsdk= new SDK(
              config('ringcentral.RINGCENTRAL_CLIENTID'),
              config('ringcentral.RINGCENTRAL_CLIENTSECRET'),
              config('ringcentral.RINGCENTRAL_SERVER')
          );
        $this->platform = $this->rcsdk->platform();
        $this->platform->login( $this->ringcenter->name, $this->ringcenter->ext,$this->ringcenter->password);
    }
    public function sendSms(User $user,PhoneTpl $phoneTpl){

        $text=str_replace('{{name}}',$user->name,$phoneTpl->tpl);

        $phoneLog=new PhoneLog();

        try{
            $resp = $this->platform->post('/account/~/extension/~/sms',
                array(
                    'from' => array ('phoneNumber' =>$this->ringcenter->name ),
                    'to' => array(array('phoneNumber' => $user->phone)),
                  //  'to' => array(array('phoneNumber' =>'+12095793478')),
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
    public function  testPhone($phone ,$desc){
        try{
            $resp = $this->platform->post('/account/~/extension/~/sms',
                array(
                    'from' => array ('phoneNumber' =>$this->ringcenter->name),
                    'to' => array(array('phoneNumber' => $phone)),
                    'text' => $desc
                ));

                return [
                    'code'=>1,
                    'message'=>json_encode($resp->jsonArray())
                ];

        }catch (\Exception $exception){
                return [
                    'code'=>0,
                    'message'=>$exception->getMessage()
                    ];
        }
    }
}
