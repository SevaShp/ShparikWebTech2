<?php
session_start();

$server = $_SESSION['adres'];    // Адрес сервера
$username = $_SESSION['nik'];    // Имя пользователя
$password = $_SESSION['pass'];   // Пароль пользователя
$dbname = $_SESSION['name'];     // Имя базы данных

// Попытка подкл
$conn = new mysqli($server, $username, $password, $dbname);

// Проверка
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $term = isset($_POST['terms']) ? $_POST['terms'] : '';
    $discr = isset($_POST['discr']) ? $_POST['discr'] : '';

  
    if (!empty($term) && !empty($discr)) {
      
        $sql = "INSERT INTO term (terms, discr) VALUES (?, ?)";

      
        if ($stmt = $conn->prepare($sql)) {
            
            $stmt->bind_param("ss", $term, $discr);

          
            if ($stmt->execute()) {
                echo "Новые данные успешно добавлены!";
            } else {
                echo "Ошибка: " . $stmt->error;
            }

           
            $stmt->close();
        }
    } else {
        echo "Пожалуйста, заполните все поля формы.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление данных</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    
<header class="header">
        <div class="container">
            <nav class="main-menu">
                <a href="index.php">Назад</a>
                <a href="table.php" class="aut">Просмотр записей</a>
            </nav>
        </div>
    </header>
    <div class="container">
        <h1>Добавьте новый термин</h1>
       
        <form action="home.php" method="post">
            <div class="form-group">
                <label for="terms">Термин:</label>
                <input type="text" id="terms" name="terms" required>
            </div>
            <div class="form-group">
                <label for="discr">Описание:</label>
                <input type="text" id="discr" name="discr" required>
            </div>
            <input type="submit" value="Добавить термин">
        </form>
    </div>
</body>
</html>
