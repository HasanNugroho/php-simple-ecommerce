<?php
session_start();
require("./CartManager.php");

$cartManager = new CartManager();

$action = $_POST['action'];
if ($action == 'add') {
    $cartManager->store($_SESSION['user_id'], $_POST['product_id'], $_POST['qty']);
    header('location: ../cart.php');
} elseif ($_GET['action'] == 'delete') {
    $id = $_GET['x'];
    $cartManager->delete_data($id);
    header('location: ../cart.php');
}
?>
