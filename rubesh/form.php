
</body>
</html>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <title>Магазин техники</title>
    <style>
        /* Общий стиль для страницы */
        
    </style>
</head>
<body>
    
    <header class="header">
        <div class="container">
             <nav class="main-menu">
             <?php
                echo '<a href="index.php"';
                ?>
             <?php
             
                echo ' >Главная</a>';
                ?>
                
                <?php
                $name = 'Магазин';
                $link = 'table.php';
                $current_page = true;
                ?>

                <a href="<?php echo $link; ?>" <?php if ($current_page)
                       echo ' class="aut"'; ?>>
                    <?php echo $name; ?>
                </a>
                <?php
                $name = 'Создать Аккаунт';
                $link = 'form.php';
                $current_page = true;
                ?>
                <a href="<?php echo $link; ?>" <?php if ($current_page)
                       echo ' class="text"'; ?>>
                    <?php echo $name; ?>
                </a>
            </nav>
        </div>
    </header>
    <div class="auth-form-container">
    <section id="about">
        <form action="https://httpbin.org/post" method="post" enctype="multipart/form-data">
            <p class="form-label">Создание аккаунта</p>
            <div class="form-group">
                <label for="FIO" class="form-label">Логин</label>
                <input id="FIO "type="text" name="FIO" placeholder="Логин" required>
            </div>

            <div class="form-group">
                <label for="pass" class="form-label">Пароль</label>
                <input id="pass "type="password" name="pass" placeholder="*********" required>
            </div>
            <div class="form-group">
                <input type="checkbox" name="agree" id="agree">
                <label for="agree">Запомнить меня</label>
            </div>
            <input type="submit" class="botton" value="Отправить">
            </section>
        </form>
        
    </div>
    <footer>
    <p>&copy; 2023 Магазин техники. Все права защищены.</p>
    <img src="images/logo.png" alt="Логотип магазина" class="footer-logo"> <!-- Логотип магазина в футере -->
</footer>
 

</body>
</html>