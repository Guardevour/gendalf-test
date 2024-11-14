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
                    $users =  DB::table('user_profiles')
                    ->join('user_groups', 'user_groups.id', '=' , 'user_profiles.user_groupId')
                    ->select('user_profiles.id as id', 'user_profiles.login as login', 'user_groups.name as user_groupId')
                    ->get();

                    foreach ($users as $user){
                        echo $user->id." ".$user->login." | ".$user->user_groupId."<br>";
                    }

                }



        ?>

        <h2>Добавление пользователя</h2>
        <form method="POST" action="/gendalf-test/public/userscreate">
            @csrf
            <input type="text" name="login" placeholder="Имя пользователя" required>
            @php
            $groups = DB::select('select * from user_groups');
            @endphp
           <select name="group">
                @foreach ($groups as $group)
                    <option  value="{{ $group->id}}"> {{ $group->name}}</option>
                @endforeach
                </select>

            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Добавить</button>
        </form>
        <h2>Изменение пользователя</h2>
        <form method="POST" action="/gendalf-test/public/usersupdate">
            @csrf
            <input type="text" name="id" placeholder="Id" required>
            <select name="group">
                @foreach ($groups as $group)
                    <option  value="{{ $group->id}}"> {{ $group->name}}</option>
                @endforeach
                </select>
            <input type="text" name="login" placeholder="Имя пользователя">
            <input type="password" name="password" placeholder="Пароль">
            <button type="submit">Изменить</button>
        </form>
        <h2>Удаление пользователя</h2>
        <form method="POST" action="/gendalf-test/public/usersdelete">
            @csrf
            <input type="number" name="id" placeholder="Id" required>
            <button type="submit">Удалить</button>
        </form>
    </div>
</body>
</html>

