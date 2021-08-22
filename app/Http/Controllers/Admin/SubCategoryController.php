<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public function index()
    {
        $subCategories = SubCategory::with('category')->orderBy('updated_at', 'DESC')->paginate(10);
       // return $subCategories;
        return view('admin.sub-categories.sub-categories')->with([
            'sub_categories' => $subCategories
        ]);
    }

    public function create()
    {

        return view('admin.sub-categories.create-sub-category')->with([
            'categories'=>Category::all()
        ]);
    }


    public function store(Request $request)
    {



        $this->validate($request,
            [
                'title' => 'required|unique:sub_categories',
                'category'=>'required'
            ],
            [
                'title.required' => 'Please enter a title',
                'title.unique' => 'This title is already taken, you can edit',


            ]
        );

            $subCategory = new SubCategory();
            $subCategory->title = $request->get('title');
            $subCategory->description = $request->get('description');
            $subCategory->category_id = $request->get('category');
            if ($subCategory->save()) {
                return redirect()->route('admin.sub-categories.index')->with('message', 'Category created');
            } else {
                return redirect()->route('admin.sub-categories.index')->with('error', 'Something wrong');
            }


    }

    public function show($id)
    {
    }


    public function edit($id)
    {
        $subCategory = SubCategory::with('category')->find($id);
        return view('admin.sub-categories.edit-sub-category')->with([
            'sub_category' => $subCategory
        ]);

    }


    public function update(Request $request,$id)
    {

        $this->validate($request,
            [
                'title'=>'required'
            ]
        );


        $subCategory = SubCategory::find($id);

        if (isset($request->active)) {
            SubCategory::activateSubCategory($id);
            $subCategory->active = true;
        }else{
            SubCategory::disableSubCategory($id);
            $subCategory->active = false;
        }

        $subCategory->title = $request->get('title');
        $subCategory->description = $request->get('description');
        if ($subCategory->save()) {
            return redirect(route('admin.sub-categories.index'))->with('message', 'Sub Category updated');
        }
        return redirect(route('admin.sub-categories.index'))->with('error', 'Sub Category not updated');
    }


    public function destroy($id){}
}
