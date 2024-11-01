<?php
// Подключение к базе данных
$host = 'localhost'; // Хост
$db = 'tech'; // Имя базы данных
$user = 'admin'; // Имя пользователя
$pass = 'admin'; // Пароль

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$sql = "SELECT id, name FROM equipment";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин техники</title>
    <link rel="stylesheet" href="styles/main.css">
    <style>
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            cursor: pointer; 
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            width: 200px; 
            height: auto; 
        }
    </style>
</head>
<body>
<header class="header">
            <div class="container">
                <nav class="main-menu">
                    <a href="table.php" class="a">Магазин</a>
                    <a href="auth.php" class="a">Войти в Аккаунт</a>
                    <a href="form.php" class="a">Создать Аккаунт</a>
                </nav>
            </div>
        </header>
<h2>Список товаров</h2>
<table>
    <tr>
        <th>Изображение</th>
        <th>Название</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
       
        while($row = $result->fetch_assoc()) {
            $imagePath = 'images/' . $row['id'] . '.jpg'; 
            echo "<tr onclick='window.location=\"product.php?id=" . $row["id"] . "\"'>";
            echo "<td><img src='$imagePath' alt='Изображение товара'></td>";
            echo "<td>" . $row["name"] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>Нет доступных товаров</td></tr>";
    }
    ?>
</table>
<footer>
    <p>&copy; 2023 Магазин техники. Все права защищены.</p>
    <img src="images/logo.png" alt="Логотип магазина" class="footer-logo"> 
</footer>
</body>
</html>

<?php
$conn->close(); 
?>
