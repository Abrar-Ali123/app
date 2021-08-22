<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Manager\ProductItemController;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class UserController extends Controller
{

    //Todo: Add auth validations

    public function index()
    {
        $users = User::paginate(3);

        return view('admin.users.users')->with([
            'users' => $users
        ]);
    }




    public function store(Request $request)
    {


    }



    public function show($id)
    {


    }


    public function edit($id)
    {

        $user = User::find($id);
        return view('admin.users.edit-user')->with([
            'user'=>$user
        ]);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
        ]);


        $user= User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;

        if(isset($request->blocked)){
            $user->blocked = true;
        }else{
            $user->blocked = false;
        }

        if($user->save()) {
            return redirect(route('admin.users.index'))->with([
                'message' => 'User Updated'
            ]);
        }else{
            return redirect()->back()->with([
                'error' => 'Something wrong'
            ]);
        }
    }

    public function destroy($id)
    {

    }

}
