<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('updated_at', 'DESC')->paginate(10);
        return view('admin.categories.categories')->with([
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('admin.categories.create-category');
    }


    public function store(Request $request)
    {

        $this->validate($request,
            [
                'title' => 'required|unique:categories',
                'description' => 'required',
                'image' => 'required'
            ],
            [
                'title.required' => 'Please enter a title',
                'title.unique' => 'This title is already taken, you can edit',
                'description.required' => 'Please provide a description',
                'image.required' => 'Please provide a image'

            ]
        );

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $category = new Category();
            $category->title = $request->get('title');
            $category->description = $request->get('description');
            $category->image_url = $path;
            if ($category->save()) {
                return redirect()->route('admin.categories.index')->with('message', 'Category created');
            } else {
                return redirect()->route('admin.categories.index')->with('error', 'Something wrong');
            }
        }
        return redirect()->route('categories.index')->with('error', 'Something wrong');

    }

    public function show($id)
    {
    }


    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit-category')->with([
            'category' => $category
        ]);

    }


    public function update(Request $request,$id)
    {

        $this->validate($request,
            [
                'description' => 'required',
                'title'=>'required'

            ], [
                'description.required' => 'Please provide a description',
            ]
        );

        $category = Category::find($id);

        if (isset($request->active)) {
            Category::activateCategory($id);
            $category->active = true;
        }else{
            Category::disableCategory($id);
            $category->active = false;
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $category->image_url = $path;
        }
        $category->title = $request->get('title');
        $category->description = $request->get('description');
        if ($category->save()) {
            return redirect(route('admin.categories.index'))->with('message', 'Category updated');
        }
        return redirect(route('admin.categories.index'))->with('error', 'Category not updated');
    }


    public function destroy($id)
    {

    }

}
