
</body>
</html>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <title>Магазин техники</title>
    
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


<main>
    <div class="description">
        <h2>О нашем магазине</h2>
        <p>Добро пожаловать в наш магазин техники! Мы предлагаем широкий ассортимент электроники и бытовой техники от ведущих производителей, гарантируя высокое качество и надежность. Наши товары соответствуют современным стандартам и подойдут для самых разных нужд — будь то домашний комфорт или профессиональное использование.</p>
        <p>В нашем каталоге вы найдете ноутбуки, смартфоны, телевизоры, аудиосистемы и множество других товаров, которые помогут сделать вашу жизнь удобнее и насыщеннее. Мы гордимся своим сервисом и всегда готовы помочь вам с выбором, предоставив исчерпывающую информацию о каждом продукте.</p>
        <p>Спасибо, что выбираете нас. Мы стараемся сделать покупки максимально комфортными и приятными для вас!</p>
    </div>
    
</main>
<div class="slideshow-container">
    <?php
    
    $images = [
        'images/Баланс.jpg',
        'images/Конкуренция.jpg',
        'images/IMG_1347 (1).jpg',
        
    ];

    
    foreach ($images as $index => $image) {
        echo '<div class="slide' . ($index === 0 ? ' active' : '') . '">';
        echo '<img src="' . $image . '" alt="Слайд ' . ($index + 1) . '">';
        echo '</div>';
    }
    ?>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>

<script>
    let slideIndex = 0; 
    const slides = document.querySelectorAll('.slide');
    
    function showSlides() {
        
        slides.forEach((slide, index) => {
            slide.style.display = 'none';
        });

        
        slideIndex++;
        if (slideIndex >= slides.length) {
            slideIndex = 0; 
        }

        slides[slideIndex].style.display = 'block';

        setTimeout(showSlides, 5000);
    }

    showSlides();

    function plusSlides(n) {
        slideIndex += n;
        if (slideIndex >= slides.length) {
            slideIndex = 0;
        } else if (slideIndex < 0) {
            slideIndex = slides.length - 1;
        }
        showSlidesManual();
    }

    function showSlidesManual() {
        slides.forEach((slide, index) => {
            slide.style.display = index === slideIndex ? 'block' : 'none';
        });
    }
</script>

<footer>
    <p>&copy; 2023 Магазин техники. Все права защищены.</p>
    <img src="images/logo.png" alt="Логотип магазина" class="footer-logo"> 
</footer>
x
</body>
</html>