<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FCMController;
use App\Models\Manager;
use App\Models\Shop;
use App\Models\ShopRevenue;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{
    public function index()
    {

    }


    public function create()
    {

        return view('admin.notifications.create-notification');

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


    public function update(Request $request, $id){

    }


    public function destroy($id)
    {

    }


    public function send(Request $request){

        $this->validate($request,[
            'title'=>'required',
            'body'=>'required'
        ]);

        $response = FCMController::sendMessageToAll($request->title,$request->body);
        //return $response->success;
        if($response){
            return redirect()->back()->with('message', 'Notification sent');
        }else{
            return redirect()->back()->with('error', 'Notification was not sent');
        }
    }
}
