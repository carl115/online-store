<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /* VIEWS */
    public function viewProduct(Product $product) 
    {
        $product = $this->getProduct($product)->original;

        return view('product', compact('product'));
    }
    /*-/-*/

    /* API */
    public function products()
    {
        $products = Product::with('category')->get();

        return response()->json($products, 200);
    }

    public function getProducts(Request $request)
    {
        $products = DB::table('products')->where('name', 'like', $request->search.'%')->get();

        return response()->json($products, 200);
    }

    public function getProduct(Product $product)
    {
        return response()->json($product, 200);
    }

    public function createProduct(Request $request)
    {
        $product = new Product($request->all());
        $this->uploadImage($request, $product);
        $product->save();

        return response()->json($product, 201);
    }

    public function updateProduct(Request $request, Product $product)
    {
        $requestAll = $request->all();
        $this->uploadImage($request, $product);
        $requestAll['image'] = $product->image;
        $product->update($requestAll);

        return response()->noContent();
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();

        return response()->noContent();
    }
    /*-/-*/

    private function uploadImage($request, &$product) {
        if(!isset($request->image)) return;

        $strRandom = Str::random(20);
        $imgName = "{$strRandom}.{$request->image->clientExtension()}";

        $request->image->move(storage_path('app/public/images'), $imgName);

        $product->image = $imgName;
    }
}
