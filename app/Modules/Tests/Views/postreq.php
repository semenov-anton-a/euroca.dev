<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>POST Test</title>
</head>
<body>

<h1>Тест POST запроса</h1>

<form action="/test/postreq" method="post">

    <div>
        <label for="email">Email:</label>
        <input
            type="email"
            id="email"
            name="email"
            placeholder="Введите email"
            required
        >
    </div>

    <br>

    <div>
        <label for="password">Пароль:</label>
        <input
            type="password"
            id="password"
            name="password"
            placeholder="Введите пароль"
            required
        >
    </div>

    <br>

    <button type="submit">
        Отправить
    </button>

</form>

</body>
</html>
