<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $product = Product::all();

        return response()->json([
            'success' => true,
            'message' => 'Lay san pham thanh cong',
            'data' => $product,
        ]);
    }


    public function store(ProductRequest $request)
    {
        $data = $request->only(['name', 'description', 'price', 'status', 'category_id']);

        $imageId = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fullName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/images', $fullName);

            $image = Image::create([
                'url' => 'storage/images/' . $fullName,
            ]);

            $imageId = $image->id;
        }


        $product = Product::create(array_merge($data, [
            'image_id' => $imageId
        ]));


        return response()->json([
            'success' => true,
            'message' => 'Tao thanh cong',
            'data' => $product
        ]);
    }


    public function show($id)
    {
        $product = Product::with('image', 'category')->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => "lay chi tiet san pham thanh cong",
            'data' => $product,
        ]);
    }



    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->only(['name', 'description', 'price', 'status', 'category_id']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fullName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/images', $fullName);

            $image = Image::create([
                'url' => 'storage/images/' . $fullName,
            ]);

            $data['image_id'] = $image->id;

            if ($product->image) {
                $product->image->delete();
            }
        }

        $product->update($data);

        return response()->json([
            'success' => true,
            'message' => 'cap nhat thanh cong',
            'data' => $product
        ]);
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xoa san pham hanh cong',
        ]);
    }
}
