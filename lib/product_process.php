<?php
session_start();
require('./User.php');
require(__DIR__ . '\Product.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$product = new Product();

if ($action == 'add') {
    echo $_POST['code'],
    $_POST['name'],
    $_POST['price'],
    $_POST['stock'],
    $_POST['description'],
    $user_id; 
    $product->store(
        $_POST['code'],
        $_POST['name'],
        $_POST['price'],
        $_POST['stock'],
        $_POST['description'],
        $user_id
    );
    header('location: ../product_list.php');
} elseif ($action == 'update') {
    $product->update_data(
        $_POST['id'],
        $_POST['code'],
        $_POST['name'],
        $_POST['price'],
        $_POST['stock'],
        $_POST['description'],
        $user_id
    );
    header('location: ../product_list.php');
} elseif ($action == 'delete') {
    $id = isset($_GET['x']) ? $_GET['x'] : null;
    $product->delete_data($id, $user_id);
    header('location: ../product_list.php');
}
?>
