<?php

namespace App\Http\Controllers;

use App\Http\Requests\SizeRequest;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{

    public function index()
    {
        $sizes = Size::all();
        return response()->json([
            'success' => true,
            'data' => $sizes,
            'message' => 'lay size thanh cong',
        ]);
    }


    public function store(SizeRequest $request)
    {
        $data = $request->only(['name']);

        $size = Size::create($data);

        return response()->json([
            'success' => true,
            'message' => "Tao thanh cong",
            'data' => $size,
        ]);
    }

    public function show(SizeRequest $size, $id)
    {
        $size = Size::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => "lay details size thanh cong",
            'data' => $size,
        ]);
    }


    public function update(SizeRequest $request, $id)
    {
        $data = $request->only(['name']);

        $size = Size::findOrFail($id);

        $size->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Cap nhat thanh cong',
            'data' => $size
        ]);
    }


    public function destroy($id) {

        $size = Size::findOrFail($id);

        $size->delete();

         return response()->json([
            'success' => true,
            'message' => 'Xoa hanh cong',
        ]);


    }
}
