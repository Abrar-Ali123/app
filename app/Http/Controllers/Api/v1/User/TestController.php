<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\FCMController;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Razorpay\Api\Api;

class TestController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function test()
    {

        $token = User::find(1)->fcm_token;
        $token = "dgwcoQCWTbGgrLKbfGGbHm:APA91bGZIu5aEMFJqNhVypr8qqhkcIxq_qJoGXxDWic44uudaqe4jilCthS8pa8umr0Qk7oJuhtRbq1TSgi9zEgpBVCWVG-arT4t7cCvvJGj3RUWK9v3iU-dgQoSdVKlUkYi8_sDBZDk";
        $title = "Test";
        $body= "Test";


        $server_key = env('FCM_SERVER_KEY');

        $json_data = [
            "to" => $token,
            "priority"=>"high",
            "notification" => [
                "title" => $title,
                "body" => $body,
                "click_action"=>"FLUTTER_NOTIFICATION_CLICK"
            ],
              "data" => [
                  'screen'=>'order'
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



}
/*
public function index()
{

}

public function create()
{

}


public function store(Request $request)
{

}

public function show($id)
{
}


public function edit($id)
{

}


public function update(Request $request)
{

}


public function destroy($id){

}
*/
