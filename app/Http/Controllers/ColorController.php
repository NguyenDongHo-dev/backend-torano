<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{

    public function index()
    {
        $color = Color::all();
        return response()->json([
            'success' => true,
            'data' => $color,
            'message' => 'lay color thanh cong',
        ]);
    }


    public function store(ColorRequest $request)
    {

        $data = $request->only(['name']);

        $color = Color::create($data);

        return response()->json([
            'success' => true,
            'message' => "Tao thanh cong",
            'data' => $color,
        ]);
    }


    public function show($id)
    {
        $color = Color::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => "lay details color thanh cong",
            'data' => $color,
        ]);
    }



    public function update(ColorRequest $request, $id)
    {

        $data = $request->only(['name']);

        $color = Color::findOrFail($id);

        $color->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Cap nhat thanh cong',
            'data' => $color
        ]);
    }


    public function destroy($id)
    {
        $color = Color::findOrFail($id);

        $color->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xoa hanh cong',
        ]);
    }
}
