
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['adres'] = $_POST['adres'];    // Адрес сервера
    $_SESSION['nik'] = $_POST['nik'];    // Имя пользователя
    $_SESSION['pass'] = $_POST['pass'];   // Пароль пользователя
    $_SESSION['name'] = $_POST['name']; 
    header('Location: home.php');
    exit();
}
?>