<!DOCTYPE html>
<html>
<head>
    <title>Пользователи</title>
    <style>
        div {
            font-size: 22px;
        }
    </style>
</head>
<body>
    <div>
        <?php

                if(DB::connection()->getPdo())
                {
                    $users =  DB::table('products')
                    ->join('categories', 'categories.id', '=' , 'products.categoryId')
                    ->select('products.id as id', 'products.name as name','products.description as desc','products.price as price', 'categories.name as category')
                    ->get();

                    foreach ($users as $user){
                        echo $user->id." ".$user->name." | ".$user->desc." ".$user->price."р. | ".$user->category."<br>";
                    }

                }



        ?>

        <h2>Добавление товара</h2>
        <form method="POST" action="/gendalf-test/public/productscreate">
            @csrf
            <input type="text" name="name" placeholder="Наименование" required>
            @php
            $categories = DB::select('select * from categories');
            @endphp
           <select name="category" required>
                @foreach ($categories as $category)
                    <option  value="{{ $category->id}}"> {{ $category->name}}</option>
                @endforeach
                </select>

                <input type="text" name="description" placeholder="Описание" required>
                <input type="number" name="price" placeholder="Цена" required>
            <button type="submit">Добавить</button>
        </form>
        <h2>Изменение товара</h2>
        <form method="POST" action="/gendalf-test/public/productsupdate">
            @csrf
            <input type="text" name="id" placeholder="Id" required>
            <select name="category">
                @foreach ($categories as $category)
                    <option  value="{{ $category->id}}"> {{ $category->name}}</option>
                @endforeach
                </select>
            <input type="text" name="name" placeholder="Наименование">
            <input type="text" name="description" placeholder="Описание">
            <input type="number" name="price" placeholder="Цена">
            <button type="submit">Изменить</button>
        </form>
        <h2>Удаление товара</h2>
        <form method="POST" action="/gendalf-test/public/productsdelete">
            @csrf
            <input type="number" name="id" placeholder="Id" required>
            <button type="submit">Удалить</button>
        </form>
    </div>
</body>
</html>

