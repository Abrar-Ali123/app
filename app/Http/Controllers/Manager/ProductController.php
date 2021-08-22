<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class ProductController extends Controller
{

    //Todo: Add auth validations

    public function index()
    {
        $shop = auth()->user()->shop;
        if (!$shop) {
            return view('manager.error-page')->with([
                'code' => 502,
                'error' => 'You havn\'t any shop yet',
                'message' => 'Please join any shop and then manage product',
                'redirect_text' => 'Join',
                'redirect_url' => route('manager.shops.index')
            ]);
        }

        $products = Product::with('productImages', 'productItems', 'productItems.productItemFeatures')->where("shop_id", "=", $shop->id)->orderBy('active', "DESC")->paginate(10);

        //return $products;
        return view('manager.products.products')->with([
            'shop' => $shop,
            'products' => $products
        ]);
    }

    public function create()
    {


        $categories = Category::with('subCategories')->get();

        $shop = auth()->user()->shop;
        if (!$shop) {
            return view('manager.error-page')->with([
                'code' => 502,
                'error' => 'You havn\'t any shop yet',
                'message' => 'Please join any shop and then add product',
                'redirect_text' => 'Join',
                'redirect_url' => route('manager.shops.index')
            ]);
        }

        return view('manager.products.create-product')->with([
            'categories' => $categories
        ]);
    }


    public function store(Request $request)
    {


        $shop = auth()->user()->shop;
        if (!$shop) {
            return view('manager.error-page')->with([
                'code' => 502,
                'error' => 'You havn\'t any shop yet',
                'message' => 'Please join any shop and then add product',
                'redirect_text' => 'Join',
                'redirect_url' => route('manager.shops.index')
            ]);
        }

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'items' => 'required'
        ]);


        $items = array_values(json_decode($request->get('items'), true));

        if(count($items)>0) {

            if (self::validateItems($items)) {
                $product = new Product();
                $product->name = $request->get('name');
                $product->description = $request->get('description');

                $subCategory = SubCategory::find($request->get('category'));

                $product->sub_category_id = $request->get('category');
                $product->category_id = $subCategory->category_id;

                if (isset($request->offer))
                    $product->offer = $request->get('offer');
                else
                    $product->offer = 0;

                $product->shop_id = $shop->id;
                $product->save();
                ProductItemController::addItemsWithClear($product->id, $items);
            } else {
                return redirect()->back()->with([
                    'error' => 'Product items are not valid (same feature with single item is not allow)'
                ]);
            }
        }else{
            return redirect()->back()->with([
                'error' => 'Add at-least one product item'
            ]);
        }
        return redirect(route('manager.product-images.edit', ['id' => $product->id]));
    }

    static function validateItems($items): bool
    {
        foreach ($items as $item) {
            $productItemFeatures = $item['product_item_features'];
            for ($i = 0; $i < sizeof($productItemFeatures); $i++) {
                for ($j = $i+1; $j < sizeof($productItemFeatures); $j++) {
                    if ($productItemFeatures[$i]["feature"] === $productItemFeatures[$j]["feature"])
                        return false ;
                }
            }

        }
        return true;
    }

    public function show($id)
    {
    }


    public function edit($id)
    {
        $shop = auth()->user()->shop;
        if (!$shop) {
            return view('manager.error-page')->with([
                'code' => 502,
                'error' => 'You havn\'t any shop yet',
                'message' => 'Please join any shop and then manage product',
                'redirect_text' => 'Join',
                'redirect_url' => route('manager.shops.index')
            ]);
        }

        $product = Product::with('shop', 'productImages', 'productItems', 'productItems.productItemFeatures')->find($id);

        if ($product) {
            if ($shop->id === $product->shop->id) {
                $categories = Category::with('subCategories')->get();
                return view('manager.products.edit-product')->with([
                    'product' => $product,
                    'categories' => $categories
                ]);
            } else {
                return view('manager.error-page')->with([
                    'code' => 502,
                    'error' => 'This is not your shop product',
                    'message' => 'Please go to your product then edit',
                    'redirect_text' => 'Go to Product',
                    'redirect_url' => route('manager.products.index')
                ]);
            }
        }
        return view('manager.error-page')->with([
            'code' => 502,
            'error' => 'This is not your shop product',
            'message' => 'Please go to your product then edit',
            'redirect_text' => 'Go to Product',
            'redirect_url' => route('manager.products.index')
        ]);

    }


    public function update(Request $request, $id)
    {

        $shop = auth()->user()->shop;
        if (!$shop) {
            return view('manager.error-page')->with([
                'code' => 502,
                'error' => 'You haven\'t any shop yet',
                'message' => 'Please join any shop and then add product',
                'redirect_text' => 'Join',
                'redirect_url' => route('manager.shops.index')
            ]);
        }


        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);


        $items = array_values(json_decode($request->get('items'), true));
        if(count($items)>0) {

            if (self::validateItems($items)) {

                $product = Product::find($id);
                $product->name = $request->get('name');
                $product->description = $request->get('description');

                $subCategory = SubCategory::find($request->get('category'));

                $product->sub_category_id = $request->get('category');
                $product->category_id = $subCategory->category_id;

                if (isset($request->active)) {
                    $product->active = true;
                } else {
                    Cart::where('product_id', '=', $product->id)->where('active', '=', true)->delete();
                    $product->active = false;
                }

                if (isset($request->offer))
                    $product->offer = $request->get('offer');
                else
                    $product->offer = 0;

                if ($product->save()) {
                    ProductItemController::updateItems($product->id, $items);
                    return redirect(route('manager.products.index'))->with([
                        'message' => 'Product Updated'
                    ]);
                } else {
                    return redirect()->back()->with([
                        'error' => 'Something wrong'
                    ]);
                }
            } else {
                return redirect()->back()->with([
                    'error' => 'Product items are not valid (same feature with single item is not allow)'
                ]);
            }
        }else{
            return redirect()->back()->with([
                'error' => 'Add at-least one product item'
            ]);
        }
    }

    public function destroy($id)
    {

    }

}
