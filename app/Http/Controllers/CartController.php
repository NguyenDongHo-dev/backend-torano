<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index($id)
    {
        $cart = Cart::with('product.image')->where('user_id', $id)->get();


        $formatted = $cart->map(function ($item) {
            $product = $item->product;
            $imageUrl = $product && $product->image
                ? asset('storage/' . $product->image->path)
                : null;

            return [
                'product_id'  => $item->product_id,
                'name'        => $product->name,
                'price'       => $product->price,
                'quantity'    => $item->quantity,
                'total_price' => $product ? $product->price * $item->quantity : null,
                'image_id'    => $product->image_id,
                'image_url'   => $imageUrl,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Lay san pham trong cart thanh cong',
            'data' => $formatted,
        ]);
    }


    public function store(CartRequest $request)
    {
        $data = $request->only(['user_id', "product_id", 'quantity']);

        $cart = Cart::where('user_id', $data['user_id'])
            ->where('product_id', $data['product_id'])
            ->first();

        if ($cart) {
            $cart->quantity += $data['quantity'];
            $cart->save();
        } else {
            $cart = Cart::create($data);
        }

        return response()->json([
            'success' => true,
            'message' => 'Them thanh cong',
            'data' => $cart->load('product')
        ]);
    }


    public function destroy(CartRequest $request, $id)
    {
        $data = $request->only(["product_id"]);

        Cart::where('user_id', $id)->where('product_id', $data['product_id'])->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xoa thanh cong',
        ]);
    }
}
