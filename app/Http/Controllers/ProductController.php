<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductController
{
    public function create(Request $request){
        $parameters = $request->only('category', 'description', 'name','price');

        DB::insert('insert into products (categoryId, description, name, price) values (?, ?, ?, ?)', [
            $parameters['category'], $parameters['description'], $parameters['name'], $parameters['price']
        ]);
        return redirect('/products');
    }

    public function update(Request $request){

        $parameters = $request->only('category', 'description', 'name','price', 'id');

        DB::table('products')
        ->where('id', $parameters['id'])
        ->update(['categoryId' => $parameters['category'],
        'name' => $parameters['name'],
        'price' => $parameters['price'],
        'description' => $parameters['description'] ]);

        return redirect('/products');
    }


    public function delete(Request $request){
        $parameters = $request->only('id');

        DB::delete('delete from products where id = ?', [$parameters['id']]);
        return redirect('/products');
    }
}
