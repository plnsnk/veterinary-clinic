<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница не найдена — Четыре с хвостиком</title>
    <link rel="icon" type="image/webp" href="/image/logo.webp">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #F0F0F0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #5A6A6D;
        }
        .error-container {
            text-align: center;
            background: #fff;
            padding: 60px 40px;
            border-radius: 30px;
            box-shadow: 0 10px 40px rgba(128, 146, 112, 0.15);
            max-width: 500px;
            width: 100%;
        }
        .error-code {
            font-size: 120px;
            font-weight: 700;
            color: #809270;
            line-height: 1;
            margin-bottom: 10px;
        }
        .error-title {
            font-size: 24px;
            color: #5A6A6D;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .error-text {
            font-size: 16px;
            color: #777;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .error-links {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .error-btn {
            display: inline-block;
            padding: 14px 30px;
            background: #809270;
            color: #fff;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .error-btn:hover {
            background: #5A6A6D;
            transform: translateY(-2px);
        }
        .error-btn-secondary {
            background: transparent;
            color: #809270;
            border: 2px solid #DAEBC0;
        }
        .error-btn-secondary:hover {
            background: #DAEBC0;
            color: #5A6A6D;
        }
        @media (max-width: 480px) {
            .error-code { font-size: 80px; }
            .error-container { padding: 40px 25px; }
            .error-title { font-size: 20px; }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <h1 class="error-title">Страница убежала, как хвостик!</h1>
        <p class="error-text">
            К сожалению, мы не можем найти страницу, которую вы ищете.
            Возможно, она была удалена или вы перешли по неверной ссылке.
        </p>
        <div class="error-links">
            <a href="/" class="error-btn">Вернуться на главную</a>
            <a href="/all-services" class="error-btn error-btn-secondary">Посмотреть услуги</a>
        </div>
    </div>
</body>
</html>