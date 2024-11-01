<?php
session_start(); 


$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id']) && isset($data['name'])) {
    $item = [
        'id' => $data['id'],
        'name' => $data['name']
    ];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $item;

    echo json_encode([
        'message' => 'Товар добавлен в корзину!',
        'cartCount' => count($_SESSION['cart'])
    ]);
} else {
    echo json_encode(['message' => 'Ошибка при добавлении товара.']);
}
?>