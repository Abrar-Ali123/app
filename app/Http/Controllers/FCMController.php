<?php

namespace App\Http\Controllers;

use App\Helpers\AppSetting;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class FCMController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function sendMessage($title,$body,$token,$screen="order")
    {

        if(!$token)
            return false;

        $server_key = AppSetting::$FCM_SERVER_KEY;

        $json_data = [
            "to" => $token,
            "priority"=>"high",
            "notification" => [
                "title" => $title,
                "body" => $body,
                "click_action"=>"FLUTTER_NOTIFICATION_CLICK"
            ],
            "data" => [
                'screen'=> $screen
            ]
        ];
        $data = json_encode($json_data);

        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $server_key
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            curl_close($ch);
            return 'Oops! FCM Send Error: ' . curl_error($ch);
        } else {
            curl_close($ch);
            return $result;
        }
    }



    public static function sendMessageToAll($title,$body): bool
    {

        $users = User::all();
        foreach ($users as $user) {
            self::sendMessage($title,$body,$user->fcm_token);
        }
        return true;
    }



    public static function test()
    {

        $token = User::find(1)->fcm_token;
        $title = "Test";
        $body= "Test";


        $server_key = AppSetting::$FCM_SERVER_KEY;

        $json_data = [
            "to" => $token,
            "priority"=>"high",
            "notification" => [
                "title" => $title,
                "body" => $body,
            ],
            /*  "data" => [
                  'key'=>'value'
              ]*/
        ];
        $data = json_encode($json_data);

        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $server_key
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        if ($result === FALSE) {
            curl_close($ch);
            return 'Oops! FCM Send Error: ' . curl_error($ch);
        } else {
            curl_close($ch);
            return $result;
        }
    }




}
