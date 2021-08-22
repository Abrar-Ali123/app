<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    public function index()
    {
        $banners = Banner::all();

        foreach ($banners as $banner) {
            $banner->url = asset('storage/' . $banner->url);
        }

        return view('admin.banners.edit-banner-images')->with([
            'banners' => $banners,
        ]);
    }

    public function create()
    {


    }


    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            return Banner::saveImageWithKey($request, 'file');
        }
        return false;

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

        $this->validate($request, [
            'id' => 'required'
        ]);

        return Banner::deleteImage($request->id);
    }

}
