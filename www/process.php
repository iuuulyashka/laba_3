<?php
session_start();

// Получаем данные формы через $_POST
$name = htmlspecialchars($_POST['name']);
$dish_count = htmlspecialchars($_POST['dish_count']);
$restaurant = htmlspecialchars($_POST['restaurant']);
$online_payment = isset($_POST['online_payment']) ? 'yes' : 'no';
$packaging = htmlspecialchars($_POST['packaging']);

// Сохраняем в сессию
$_SESSION['username'] = $name;
$_SESSION['dish_count'] = $dish_count;
$_SESSION['restaurant'] = $restaurant;
$_SESSION['online_payment'] = $online_payment;
$_SESSION['packaging'] = $packaging;

// Рассчитываем стоимость
$base_price = $dish_count * 450; // 450₽ за блюдо
$packaging_price = 0;

if ($packaging === 'eco') {
    $packaging_price = 50;
} elseif ($packaging === 'premium') {
    $packaging_price = 100;
}

$total_price = $base_price + $packaging_price;

// Применяем скидку за онлайн оплату
if ($online_payment === 'yes') {
    $total_price = $total_price * 0.95; // 5% скидка
}

$_SESSION['price'] = round($total_price) . '₽';

// Сохраняем в файл
$dataLine = $name . ";" . $dish_count . ";" . $restaurant . ";" . $online_payment . ";" . $packaging . ";" . $_SESSION['price'] . ";" . date('Y-m-d H:i:s') . "\n";
file_put_contents("data.txt", $dataLine, FILE_APPEND);

// Перенаправляем обратно на главную страницу
header("Location: index.php");
exit();
?>