<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::orderBy('expired_at', 'ASC')->paginate(10);
        return view('admin.coupons.coupons')->with([
            'coupons' => $coupons
        ]);
    }

    public function create()
    {

        return view('admin.coupons.create-coupon');
    }


    public function store(Request $request)
    {


        $this->validate($request,
            [
                'code' => 'required|unique:coupons',
                'description' => 'required',
                'offer' => 'required|numeric|max:100|min:0"',
                'expired_at' => 'required|date|after:now',
                'min_order'=>'required',
                'max_discount'=>'required'
            ],
            [
                'code.required' => 'Please provide coupon code',
                'code.unique' => 'This coupon code has been taken, you can edit',
                'description.required'=> 'Please provide coupon description',
                'offer.required'=> 'Please provide coupon offer',
                'offer.min'=> "Please set coupon discount between 0-100%",
                'offer.max'=> "Please set coupon discount between 0-100%",
                'expired_at.after'=> 'The expired at must be a date after today',
                'min_order.required'=> 'Please provide minimum order',
                'max_discount.required'=> 'Please provide maximum discount',
            ]
        );


        $coupon = new Coupon();
        $coupon->code = $request->get('code');
        $coupon->description = $request->get('description');
        $coupon->offer = $request->get('offer');
        $coupon->min_order = $request->get('min_order');
        $coupon->max_discount = $request->get('max_discount');
        $coupon->expired_at = $request->get('expired_at');

        if(isset($request->for_new_user)){
            $coupon->for_new_user = true;
        }else{
            $coupon->for_new_user = false;
        }

        if(isset($request->for_new_user)){
            $coupon->for_only_one_time = true;
        }else{
            $coupon->for_only_one_time = false;
        }

        if($coupon->save()){
            return redirect(route('admin.coupons.index'))->with('message', 'Coupon added');
        }else{
            return redirect(route('admin.coupons.index'))->with('error', 'Coupon was not added');
        }
    }

    public function show($id)
    {
    }


    public function edit($id)
    {
        $coupon  = Coupon::find($id);

        return view('admin.coupons.edit-coupon')->with([
            'coupon'=>$coupon
        ]);

    }


    public function update(Request $request,$id)
    {
        $this->validate($request,
            [
                'description' => 'required',
                'expired_at' => 'required|date|after:now'
            ],
            [
                'description.required'=> 'Please provide coupon description',
                'expired_at.after'=> 'The expired at must be a date after today'
            ]
        );

        $coupon = Coupon::find($id);
        $coupon->description = $request->get('description');
        $coupon->expired_at = $request->get('expired_at');
        if(isset($request->is_active)){
            $coupon->is_active = true;
        }else{
            $coupon->is_active = false;
        }
        if($coupon->save()){
            return redirect(route('admin.coupons.index'))->with('message', 'Coupon updated');
        }else{
            return redirect(route('admin.coupons.index'))->with('error', 'Coupon was not updated');
        }
    }


    public function destroy($id)
    {

    }
}
