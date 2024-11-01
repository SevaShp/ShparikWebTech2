<?php

$host = 'localhost'; // Хост
$db = 'tech'; // Имя базы данных
$user = 'admin'; // Имя пользователя
$pass = 'admin'; // Пароль

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);
    $sql = "SELECT * FROM equipment WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        $product = null; 
    }
    $stmt->close();
} else {
    $product = null; 
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product ? $product['name'] : 'Товар не найден'; ?></title>
    <link rel="stylesheet" href="styles/main.css">
    <style>
        
        .modal {
            display: none; 
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h1><?php echo $product ? $product['name'] : 'Товар не найден'; ?></h1>

<?php if ($product): ?>
    <img src="images/<?php echo $product['id']; ?>.jpg" alt="Изображение товара" style="width: 300px; height: auto;">
    <p><strong>ID:</strong> <?php echo $product['id']; ?></p>
    <p><strong>Название:</strong> <?php echo $product['name']; ?></p>
    <p><strong>Характеристики:</strong> <?php echo $product['characteristics']; ?></p>
    <p><strong>Примечания:</strong> <?php echo $product['discrimination']; ?></p>
    
    
    <button id="buyButton" onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo $product['name']; ?>')">Купить</button>
<?php else: ?>
    <p>Товар не найден.</p>
<?php endif; ?>


<button id="cartButton" onclick="openCart()">Корзина (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</button>

<div id="cartModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeCart()">&times;</span>
        <h2>Корзина</h2>
        <div id="cartItems">
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    echo "<p>" . htmlspecialchars($item['name']) . " (ID: " . htmlspecialchars($item['id']) . ")</p>";
                }
            } else {
                echo "<p>Корзина пуста.</p>";
            }
            ?>
        </div>
    </div>
</div>
<script>
   
    function addToCart(id, name) {
        const item = { id: id, name: name };

        fetch('add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(item)
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message); 
            document.getElementById('cartButton').innerText = "Корзина (" + data.cartCount + ")"; 
        });
    }

    function openCart() {
        document.getElementById("cartModal").style.display = "block";
    }

    function closeCart() {
        document.getElementById("cartModal").style.display = "none";
    }
    
    window.onclick = function(event) {
        const modal = document.getElementById("cartModal");
        if (event.target === modal) {
            closeCart();
        }
    }

</script>

</body>
</html>

<?php
$conn->close(); 
?>