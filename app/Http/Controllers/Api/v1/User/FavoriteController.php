<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        return Favorite::with('product','product.productImages','product.shop','product.productItems','product.productItems.productItemFeatures')
            ->where('user_id','=',$user_id)->get();
    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'product_id'=>'required'
        ]);

        $favourite = Favorite::where('user_id','=',$request->user()->id)
            ->where('product_id','=',$request->product_id)->first();

        if($favourite){
            if ($favourite->delete()) {
                return response(['message' => 'Changed','is_favorite'=>false], 200);
            }else{
                return response(['errors' => ['Something wrong']], 403);
            }
        }
        $favourite = new Favorite();
        $favourite->user_id = $request->user()->id;
        $favourite->product_id = $request->product_id;
        if ($favourite->save()) {
            return response(['message' => 'Changed','is_favorite'=>true], 200);
        }else{
            return response(['errors' => ['Something wrong']], 403);
        }
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


    public function destroy(Request $request){
    }


}
