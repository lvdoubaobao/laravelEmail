<?php


namespace App\Reoisitory;

use App\PhoneCorn;
use App\PhoneHuihua;
use App\PhoneLog;
use App\PhoneTpl;
use App\RingCenter;
use App\User;
use Illuminate\Support\Facades\Redis;
use RingCentral\SDK\SDK;
use function Clue\StreamFilter\fun;
use function Matrix\add;

class RingcentralReoisitory
{
    protected $rcsdk;
    protected $platform;
    protected $ringcenter;

    public function __construct(RingCenter $ringcenter)
    {
        $this->ringcenter = $ringcenter;
        $this->rcsdk = new SDK(
            config('ringcentral.RINGCENTRAL_CLIENTID'),
            config('ringcentral.RINGCENTRAL_CLIENTSECRET'),
            config('ringcentral.RINGCENTRAL_SERVER')
        );
        $this->platform = $this->rcsdk->platform();

        $this->platform->login($this->ringcenter->name, $this->ringcenter->ext, $this->ringcenter->password);
    }

    /**
     * @param $user User|String
     * @param PhoneTpl $phoneTpl
     */
    public function sendSms( $user, PhoneTpl $phoneTpl,PhoneCorn $phoneCorn)
    {
        if (is_string($user)){
            $phone=$user;
            $user=new User();
            $user->name='ringcenter';
            $user->phone=$phone;
        }
       $phone= PhoneLog::where('phone',$user->phone)->where('status',1)->where('tpl_id',$phoneCorn->id)->first();
       if ($phone){
           \Log::info('已经发送',[$user->phone]);
           return true;
       }
        $text = str_replace('{{name}}', $user->name, $phoneTpl->tpl);
        $phoneLog = new PhoneLog();
        try {
                    $request = $this->rcsdk->createMultipartBuilder()
                        ->setBody(array(
                            'from' => array('phoneNumber' => $this->ringcenter->name),
                            'to' => array(array('phoneNumber' => $user->phone)),
                            'text' => $text
                        ));
                    if (!empty($phoneTpl->image)) {
                        foreach ($phoneTpl->image as $file) {
                            $request = $request->add(fopen(storage_path('app/public/' . $file), 'r'), $file);
                        }
                    }
                    $request=$request->request('/account/~/extension/~/sms');
                    $resp = $this->platform->sendRequest($request);
                    $phoneLog->message = json_encode($resp->jsonArray());
                    $phoneLog->admin_id=$user->admin_id;
                    $phoneLog->phone = $user->phone;
                    $phoneLog->tpl_id=$phoneCorn->id;
                    $phoneLog->status = 1;
                    $phoneLog->save();
                    $phoneCorn->number= $phoneCorn->number+1;
                    $phoneCorn->save();
                    sleep(2);
                    return [
                        'code' => 1,
                        'message' => json_encode($resp->jsonArray())
                    ];


        } catch (\Exception $exception) {
            $phoneLog->phone = $user->phone;
            $phoneLog->status = 0;
            $phoneLog->admin_id=$user->admin_id;
            $phoneLog->tpl_id=$phoneCorn->id;
            $phoneLog->reason = $exception->getMessage();
            $phoneLog->save();
            return [
                'code' => 0,
                'message' => $exception->getMessage()
            ];
        }
    }
    public function sendSms1( $user, PhoneTpl $phoneTpl)
    {
        if (is_string($user)){
            $phone=$user;
            $user=new User();
            $user->name='ringcenter';
            $user->phone=$phone;
        }
        $text = str_replace('{{name}}', $user->name, $phoneTpl->tpl);
        $phoneLog = new PhoneLog();
        try {

            $request = $this->rcsdk->createMultipartBuilder()
                ->setBody(array(
                    'from' => array('phoneNumber' => $this->ringcenter->name),
                    'to' => array(array('phoneNumber' => $user->phone)),
                    'text' => $text
                ));
            if (!empty($phoneTpl->image)) {
                foreach ($phoneTpl->image as $file) {
                    $request = $request->add(fopen(storage_path('app/public/' . $file), 'r'), $file);
                }
            }
            $request=$request->request('/account/~/extension/~/sms');
            $resp = $this->platform->sendRequest($request);
            $phoneLog->message = json_encode($resp->jsonArray());
            $phoneLog->admin_id=$user->admin_id;
            $phoneLog->phone = $user->phone;
            $phoneLog->status = 1;
            $phoneLog->save();
            return [
                'code' => 1,
                'message' => json_encode($resp->jsonArray())
            ];
        } catch (\Exception $exception) {
            $phoneLog->phone = $user->phone;
            $phoneLog->status = 0;
            $phoneLog->admin_id=$user->admin_id;
            $phoneLog->tpl_id=$phoneTpl->id;
            $phoneLog->reason = $exception->getMessage();
            $phoneLog->save();
            return [
                'code' => 0,
                'message' => $exception->getMessage()
            ];
        }
    }
    public function blackList(){
        $page=1;
        $totalPage=100;
        while ($page<=$totalPage){
            $response = $this->platform->get('/account/~/extension/~/message-store',
                array(
                    'messageType' => array('SMS'),
                    'page'=>$page,
                ));
             $data=json_decode( $response->text(),true);
             $page++;
             $totalPage=$data['paging']['totalPages'];
             foreach ($data['records'] as $item){
                $phoneHuihua= PhoneHuihua::whereConversationId($item['conversationId'])->first();
                if (!$phoneHuihua){
                    $phoneHuihua=new PhoneHuihua();
                    $phoneHuihua->to=$item['to'];
                    $phoneHuihua->from=$item['from'];
                    $phoneHuihua->type=$item['type'];
                    $phoneHuihua->creationTime=$item['creationTime'];
                    $phoneHuihua->readStatus=$item['readStatus'];
                    $phoneHuihua->priority=$item['priority'];
                    $phoneHuihua->attachments=$item['attachments'];
                    $phoneHuihua->subject=$item['subject'];
                    $phoneHuihua->conversation_id=$item['conversationId'];
                    $phoneHuihua->save();
                }
             }

        }


         return $response->text();
    }
    public function testPhone($phone, $desc, $files = [])
    {
        try {
            $request = $this->rcsdk->createMultipartBuilder()
                ->setBody(array(
                    'from' => array('phoneNumber' => $this->ringcenter->name),
                    'to' => array(array('phoneNumber' => $phone)),
                    'text' => $desc
                ));
            if (!empty($files)) {
                foreach ($files as $file) {
                    $request = $request->add(fopen(storage_path('app/' . $file), 'r'), $file);
                }
            }
            $request = $request->request('/account/~/extension/~/sms');
            $resp = $this->platform->sendRequest($request);
            /* $resp = $this->platform->post('/account/~/extension/~/sms',
                       array(
                           'from' => array ('phoneNumber' =>$this->ringcenter->name),
                           'to' => array(array('phoneNumber' => $phone)),
                           'text' => $desc
                       ));*/
            $aa=$resp->response()->getHeaders();
            return [
                'code' => 1,
                'message' => json_encode($resp->jsonArray())
            ];

        } catch (\Exception $exception) {
            return [
                'code' => 0,
                'message' => $exception->getMessage()
            ];
        }
    }
}
