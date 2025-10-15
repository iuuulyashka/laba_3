<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказ доставки еды - Лабораторная 3</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ff6b6b 0%, #feca57 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 800px;
            margin: 0 auto;
        }
        
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }
        
        .nav {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .nav a {
            display: inline-block;
            background: #ff6b6b;
            color: white;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        
        .nav a:hover {
            background: #ff5252;
        }
        
        .session-data, .errors {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #48cae4;
        }
        
        .errors {
            border-left-color: #e74c3c;
            color: #d63031;
        }
        
        .data-item {
            margin-bottom: 10px;
            padding: 10px;
            background: white;
            border-radius: 5px;
            border-left: 3px solid #ff6b6b;
        }
        
        .success {
            background: #d4edda;
            border-left-color: #28a745;
            color: #155724;
        }
        
        .price {
            font-weight: bold;
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🍕 Заказ доставки еды - Лабораторная 3</h1>
        
        <div class="nav">
            <a href="form.html">📝 Сделать заказ</a>
            <a href="view.php">📊 История заказов</a>
        </div>

        <?php if(isset($_SESSION['errors'])): ?>
            <div class="errors">
                <h3>❌ Ошибки при заказе:</h3>
                <ul>
                    <?php foreach($_SESSION['errors'] as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php unset($_SESSION['errors']); ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['username'])): ?>
            <div class="session-data success">
                <h3>✅ Заказ успешно оформлен!</h3>
                <div class="data-item">
                    <strong>👤 Имя:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?>
                </div>
                <div class="data-item">
                    <strong>🍽️ Количество блюд:</strong> <?php echo htmlspecialchars($_SESSION['dish_count']); ?> шт.
                </div>
                <div class="data-item">
                    <strong>🏪 Ресторан:</strong> <?php echo htmlspecialchars($_SESSION['restaurant']); ?>
                </div>
                <div class="data-item">
                    <strong>💳 Оплата онлайн:</strong> <?php echo ($_SESSION['online_payment'] == 'yes') ? '✅ Да' : '❌ Нет'; ?>
                </div>
                <div class="data-item">
                    <strong>📦 Тип упаковки:</strong> <?php echo htmlspecialchars($_SESSION['packaging']); ?>
                </div>
                <div class="data-item price">
                    <strong>💵 Стоимость:</strong> <?php echo htmlspecialchars($_SESSION['price']); ?>
                </div>
            </div>
            <?php 
            // Очищаем данные сессии после показа
            unset($_SESSION['username']);
            unset($_SESSION['dish_count']);
            unset($_SESSION['restaurant']);
            unset($_SESSION['online_payment']);
            unset($_SESSION['packaging']);
            unset($_SESSION['price']);
            ?>
        <?php else: ?>
            <div class="session-data">
                <p>📋 Заказов пока нет. Сделайте первый заказ!</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>