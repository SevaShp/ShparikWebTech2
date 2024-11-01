<?php
session_start(); 

$host = 'localhost'; // Хост
$db = 'tech'; // Имя вашей базы данных
$user = 'admin'; // Имя пользователя базы данных
$pass = 'admin'; // Пароль базы данных

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['FIO'];
    $password = $_POST['pass'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();


        if ($password==$hashed_password) {
            $_SESSION['username'] = $username;
            header("Location: table.php");
            exit();
        } else {
            $error = "Неверный пароль.";
        }
    } else {
        $error = "Пользователь не найден.";
    }
    $stmt->close();
}

$conn->close(); // Закрытие соединения с базой данных
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <title>Авторизация</title>
</head>
<body>
    
    <header class="header">
        <div class="container">
            <nav class="main-menu">
                <a href="index.php">Главная</a>
                <a href="table.php" class="aut">Магазин</a>
                <a href="form.php" class="text">Создать Аккаунт</a>
            </nav>
        </div>
    </header>
    
    <div class="auth-form-container">
        <section id="about">
            <form action="" method="post" enctype="multipart/form-data">
                <p class="form-label">Авторизация</p>
                <div class="form-group">
                    <label for="FIO" class="form-label">Логин</label>
                    <input id="FIO" type="text" name="FIO" placeholder="Логин" required>
                </div>

                <div class="form-group">
                    <label for="pass" class="form-label">Пароль</label>
                    <input id="pass" type="password" name="pass" required>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="agree" id="agree">
                    <label for="agree">Запомнить меня</label>
                </div>
                <input type="submit" class="botton" value="Отправить">
                
                <?php if (isset($error)): ?>
                    <p style="color: red;"><?php echo $error; ?></p>
                <?php endif; ?>
            </form>
        </section>
    </div>
    
    <footer>
        <p>&copy; 2023 Магазин техники. Все права защищены.</p>
        <img src="images/logo.png" alt="Логотип магазина" class="footer-logo"> 
    </footer>
</body>
</html>
