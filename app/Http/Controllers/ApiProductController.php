<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ApiProductController
{

    public function showItems(Request $request)
    {
        $name = $request->query('name');
        $items = DB::table('products')
        ->where('name', 'like', '%'.$name.'%')
        ->get();

        return response()->json(
            ['items' => $items],
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function show(int $id)
    {
        $item = DB::table('products')
        ->where('id', '=', $id)
        ->get();

        if (count($item) < 1) {
            return response()->json([
                'error_code' => 404,
                'error_message' => 'Product not found'
            ], 404);
        }

        return response()->json(
            $item,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function showCategories(Request $request)
    {
        $name = $request->query('name');
        $items = DB::table('categories')
        ->where('name', 'like', '%'.$name.'%')
        ->get();

        return response()->json(
            ['categories' => $items],
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }


}
