<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishlistRequest;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index($id)
    {

        $wishlist  = Wishlist::with('product')->where('user_id', $id)->get();
        $products = $wishlist->pluck('product');

        return response()->json([
            'success' => true,
            'data' => $products,
            'message' => 'Lay san pham wishlist thanh cong',
        ]);
    }


    public function store(WishlistRequest $request)
    {
        $data = $request->only(['user_id', 'product_id']);


        $wishlist = Wishlist::create($data);

        return response()->json([
            'success' => true,
            'message' => "Tao wishlist thanh cong",
            'data' => $wishlist,
        ]);
    }


    public function destroy(WishlistRequest $request, $id)
    {
        $productId = $request->input('product_id');

        Wishlist::where('user_id', $id)->where('product_id', $productId)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xoa thanh cong',

        ]);
    }
}
