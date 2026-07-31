<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>POST Test</title>
</head>
<body>

<h1>Тест POST запроса</h1>
<script type="text/javascript">
    
</script>
<form action="<?= $post_action ?>" method="post">

    <div>
        <label for="email">Email:</label>
        <input
            type="email"
            id="email"
            name="email"
            placeholder="Введите email"
            required
            value="semenov.anton.a@gmail.com"
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
            value="12345678"
        >
    </div>

    <br>

    <button type="submit">
        Отправить
    </button>

</form>

</body>
</html>
