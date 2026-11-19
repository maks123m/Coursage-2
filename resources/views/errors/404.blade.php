<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — SoundCrafted</title>
    @vite('resources/css/mistake.css')
</head>
<body>
    <div class="error-wrapper">
        <div class="error-block">
            <h1 class="error-title">404</h1>
            <p class="error-text">Страница не найдена</p>
            <div class="error-desc">
                Похоже, вы попали не туда.<br>
                Возможно, страница была удалена или временно недоступна.
            </div>
            <a href="{{ route('home') }}" class="error-btn">Вернуться на главную</a>
        </div>
    </div>
</body>
</html>