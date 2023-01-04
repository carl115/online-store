<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function getPurchases()
    {
        $purchases = Purchase::with(['user', 'product'])->get();

        return response()->json($purchases, 200);
    }

    public function getPurchase(Purchase $purchase)
    {
        return response()->json($purchase, 200);
    }

    public function searchProduct(Request $request) 
    {
        $product = DB::table('purchases')->where('product_id', 'like', $request->product.'%')->get();

        return response()->json($product, 200);
    }

    public function createPurchase(Request $request)
    {
        $purchase = new Purchase($request->all());
        $purchase->save();

        return response()->json($purchase, 201);
    }

    public function updatePurchase(Request $request, Purchase $purchase)
    {
        $purchase->update($request->all());

        return response()->noContent();
    }

    public function deletePurchase(Purchase $purchase)
    {
        $purchase->delete();

        return response()->noContent();
    }
}
