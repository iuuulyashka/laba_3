<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>История заказов</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #ff6b6b;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .nav {
            text-align: center;
            margin: 20px 0;
        }
        .nav a {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 20px;
            background: #ff6b6b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .price {
            font-weight: bold;
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📊 История заказов</h2>
        
        <div class="nav">
            <a href="index.php">На главную</a>
            <a href="form.html">Новый заказ</a>
        </div>

        <?php
        if(file_exists("data.txt") && filesize("data.txt") > 0){
            $lines = file("data.txt", FILE_IGNORE_NEW_LINES);
            echo '<table>';
            echo '<tr><th>Имя</th><th>Блюда</th><th>Ресторан</th><th>Оплата онлайн</th><th>Упаковка</th><th>Стоимость</th><th>Время заказа</th></tr>';
            
            foreach($lines as $line){
                $data = explode(";", $line);
                if(count($data) >= 6){
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($data[0]) . '</td>';
                    echo '<td>' . htmlspecialchars($data[1]) . ' шт.</td>';
                    
                    // Преобразуем код ресторана в читаемое название
                    $restaurant_names = [
                        'pizza' => '🍕 Пицца',
                        'sushi' => '🍣 Суши',
                        'burger' => '🍔 Бургер',
                        'asia' => '🥡 Азиатская',
                        'healthy' => '🥗 Здоровая'
                    ];
                    $restaurant_display = $restaurant_names[$data[2]] ?? $data[2];
                    echo '<td>' . htmlspecialchars($restaurant_display) . '</td>';
                    
                    echo '<td>' . (($data[3] == 'yes') ? '✅ Да' : '❌ Нет') . '</td>';
                    
                    // Преобразуем код упаковки в читаемое название
                    $packaging_names = [
                        'standard' => '📦 Стандарт',
                        'eco' => '🌿 Эко',
                        'premium' => '🎁 Премиум'
                    ];
                    $packaging_display = $packaging_names[$data[4]] ?? $data[4];
                    echo '<td>' . htmlspecialchars($packaging_display) . '</td>';
                    
                    echo '<td class="price">' . htmlspecialchars($data[5]) . '</td>';
                    echo '<td>' . (isset($data[6]) ? htmlspecialchars($data[6]) : '') . '</td>';
                    echo '</tr>';
                }
            }
            echo '</table>';
        } else {
            echo '<p>Заказов пока нет</p>';
        }
        ?>
    </div>
</body>
</html>