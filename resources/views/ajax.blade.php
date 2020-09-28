<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        {{Form::open(['route'=>'ajax'])}}
            <p>Категория: <input name="cat" type="text" value="23"></p>
            <p>Подписчиков от: <input name="min" type="text" value="0"></p>
            <p>Подписчиков до: <input name="max" type="text" value="120000000"></p>
            <p>Сколько парсить: <input name="count" type="text" value="200"></p>

            <label for="type">Период</label>
            <p><input name="period" type="radio" value="day">День</p>
            <p><input name="period" type="radio" value="week">Неделя</p>
            <p><input name="period" type="radio" value="month">Месяц</p>

            <label for="type">Тип</label>
            <p><input name="type" type="radio" value="1">Паблики</p>
            <p><input name="type" type="radio" value="2">Группы</p>
            <p><input name="type" type="radio" value="3">Все</p>

            <label for="type">Статус</label>
            <p><input name="status" type="radio" value="-1">Все группы</p>
            <p><input name="status" type="radio" value="1">Открытые</p>
            <p><input name="status" type="radio" value="2">Закрытые</p>

            <p><input name="verified" type="checkbox" value="1">Только оффициальные</p>

            <button type="submit">Парсить</button>
        {{Form::close()}}
</body>
</html>
