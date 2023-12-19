<?php
session_start();
require('../koneksi.php');

class CartManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function checkCart($userId) {
        $query = mysqli_query($this->conn, "SELECT id FROM cart WHERE user_id = '$userId'");
        return $query->fetch_array();
    }
    
    public function checkCartByProduct($product_id, $userId) {
        $query = mysqli_query($this->conn, "SELECT ci.id FROM cart c LEFT JOIN cart_item ci ON c.id = ci.cart_id WHERE ci.product_id = '$product_id' AND c.user_id = '$userId'");
        return $query->fetch_array();
    }

    public function getCartItem($cart_itemId) {
        $query = mysqli_query($this->conn, "select * from cart_item where id='$cart_itemId'");
        return $query->fetch_array();
    }

    public function getProduct($product_id) {
        $query = mysqli_query($this->conn, "select * from products where id='$product_id'");
        return $query->fetch_array();
    }

    public function updateStock($product_id, $qty, $action) {
        if ($action == 'add') {
            mysqli_query($this->conn, "update products set stock = stock + '$qty' where id = '$product_id';");
        } else {
            mysqli_query($this->conn, "update products set stock = stock - '$qty' where id = '$product_id';");
        }
    }

    public function store($userId, $product_id, $qty) {
        $cartId = $this->checkCart($userId);
        $cartId = $cartId['id'];

        if (!$cartId) {
            mysqli_query($this->conn, "insert into cart (user_id) values ('$userId');");
            $cartId = mysqli_insert_id($this->conn);
        }

        $product = $this->getProduct($product_id);
        $subtotal = $product['price'] * $qty;

        $cart_item = $this->checkCartByProduct($product_id, $userId);

        if (!is_null($cart_item['id'])) {
            $cart_item_id = $cart_item['id'];
            mysqli_query($this->conn, "update cart_item set qty = qty + '$qty', subtotal = subtotal + '$subtotal' where id = '$cart_item_id';");
        } else {
            mysqli_query($this->conn, "insert into cart_item (cart_id,product_id,qty,subtotal) 
            values ('$cartId','$product_id','$qty','$subtotal')");
        }


        $this->updateStock($product_id, $qty, 'min');
    }

    public function delete_data($id) {
        $item = $this->getCartItem($id);

        $this->updateStock($item['product_id'], $item['qty'], 'add');

        mysqli_query($this->conn, "delete from cart_item where id = '$id';");
    }
}

$cartManager = new CartManager($conn);

$action = $_GET['action'];
if ($action == 'add') {
    $cartManager->store($_SESSION['user_id'], $_GET['product_id'], $_GET['qty']);
    header('location: ../cart.php');
} elseif ($action == 'delete') {
    $id = $_GET['x'];
    $cartManager->delete_data($id);
    header('location: ../cart.php');
}
?>
