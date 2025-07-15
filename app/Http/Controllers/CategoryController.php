<?php

namespace App\Http\Controllers;

use App\Http\Requests\CaterogyRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();

        return response()->json([
            'success' => true,
            'message' => 'Lay tat ca categories thanh cong',
            'data' => $categories,
        ]);
    }




    public function create(CaterogyRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tao category thanh cong',
            'data' => $category,
        ]);
    }


    public function store(Request $request)
    {
        //
    }


    public function show(CaterogyRequest $request, $id)
    {
        $category = Category::with('children')->findOrFail($id);


        return response()->json([
            'success' => true,
            'message' => "lay chi tiet category thanh cong",
            'data' => $category,
        ]);
    }


    public function edit(CaterogyRequest $request, $id) {}


    public function update(CaterogyRequest $request, $id)
    {
        $data = $request->only(['name', 'parent_id', 'status']);

        $category = Category::findOrFail($id);

        $category->update($data);

        return response()->json([
            "success" => true,
            'message' => 'Cap nhat thanh cong',
            'data' => $category,
        ]);
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => 'Xoa thanh cong',
        ]);
    }
}
