<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    public function index()
    {
        return Banner::all();
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


    public function update(Request $request, $id)
    {


    }

    public function destroy(Request $request)
    {

    }

}
