<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Manager;

use App\Models\Product;
use App\Models\Shop;
use App\Models\ShopRevenue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:user');
    }


    public function index()
    {

        $categories = Category::all();

        $shops = Shop::all();

        //---------------- Trending total count -----------------------//
        $productsCount = array();
        $totalProducts = Product::count();
        for ($i=0;$i<$totalProducts;$i++){
            $productsCount[$i+1] = 0;
        }
        $carts = Cart::where('active',false)->get();

        foreach ($carts as $cart){
            $productsCount[$cart->product_id] += $cart->quantity;
        }

        $productsCountCache = $productsCount;

        $productsIdSorted = collect();

        for($i=0;count($productsIdSorted)<7 && $i<count($carts);$i++) {

            $maxIndex = self::getMaxValueFromArray($productsCount);
            $productsIdSorted->push($maxIndex);
            $productsCount[$maxIndex] = 0;
            $productsIdSorted=$productsIdSorted->unique();
        }


        $trendingProducts = [];

        foreach ($productsIdSorted as $singleProductId){
            $product = Product::with('productImages','productItems')->find($singleProductId);
            $product['selling_count'] = $productsCountCache[$singleProductId];
            array_push($trendingProducts,$product);
        }



        //---------------- Trending weekly Products ---------------------//
        $productsCount = array();
        $totalProducts = Product::count();
        for ($i=0;$i<$totalProducts;$i++){
            $productsCount[$i+1] = 0;
        }
        $carbonDate = Carbon::today()->subDays(7)->toDateString();
        $carts = Cart::where('active',false)->whereDate('updated_at', '>=', $carbonDate)->get();

        foreach ($carts as $cart){
            $productsCount[$cart->product_id] += $cart->quantity;
        }

        $productsCountCache = $productsCount;


        $productsIdSorted = collect();

        for($i=0;count($productsIdSorted)<7 && $i<count($carts);$i++) {

            $maxIndex = self::getMaxValueFromArray($productsCount);
            $productsIdSorted->push($maxIndex);
            $productsCount[$maxIndex] = 0;
            $productsIdSorted=$productsIdSorted->unique();
        }


        $trendingWeeklyProducts = [];

        foreach ($productsIdSorted as $singleProductId){
            $product = Product::with('productImages','productItems')->find($singleProductId);
            $product['selling_count'] = $productsCountCache[$singleProductId];
            array_push($trendingWeeklyProducts,$product);
        }




        return view('user.dashboard')->with([
            'categories'=>$categories,
            'shops'=>$shops,
            'trending_products'=>$trendingProducts,
            'trending_weekly_products'=>$trendingWeeklyProducts
        ]);

    }


    public static function getMaxValueFromArray($array): int
    {

        $maxValue=$array[1];
        $maxValueIndex=1;

        for($i=1;$i<count($array);$i++){
            if($maxValue<=$array[$i]){
                $maxValue = $array[$i];
                $maxValueIndex = $i;
            }

        }

        return $maxValueIndex;
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


    public function edit()
    {
        $user = auth()->user();

        return view('user.auth.setting', [
            'user' => $user
        ]);
    }


    public function update(Request $request)
    {

//        return redirect()->back()->with([
//            'error' => "You can't change in demo mode"
//        ]);
//


        $user = auth()->user();
        $this->validate($request,
            [
                'name' => 'required',
            ]);


        if ($request->hasFile('image')) {
            User::updateUserAvatar($request, $user->id);
        }

        if(isset($request->password)){
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->get('name');
        if ($user->save()) {
            return redirect()->back()->with([
                'message' => 'Profile updated'
            ]);
        }
        return redirect()->back()->with([
            'error' => 'Something wrong'
        ]);

    }


    public function destroy($id)
    {

    }


    public function updateLocale($langCode){
        $user = auth()->user();
        $user->locale = $langCode;
        if($user->save()){
            return redirect()->back()->with([
                'message' => 'Language changed'
            ]);
        }else{
            return redirect()->back()->with([
                'error' => 'Something wrong'
            ]);
        }

    }



}
