<?php


namespace App\Reoisitory;

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
    public function sendSms(){
    $resp = $this->platform->post('/account/~/extension/~/sms',
            array(
                'from' => array ('phoneNumber' =>  config('ringcentral.RINGCENTRAL_USERNAME')),
                'to' => array(array('phoneNumber' => 15036158397)),
                'text' => 'Hello World from PHP'
            ));
        return $resp->json()->messageStatus;

    }
}
