<?php
require_once(__DIR__ . '\koneksi.php');

class CartManager {
    private $db;
    public function __construct() {
        $conn = new database();
        $this->db = $conn->conn();
    }

    public function checkCart($userId) {
        $query = mysqli_query($this->db, "SELECT id FROM cart WHERE user_id = '$userId'");
        return $query->fetch_array();
    }
    
    public function checkCartByProduct($product_id, $userId) {
        $query = mysqli_query($this->db, "SELECT ci.id FROM cart c LEFT JOIN cart_item ci ON c.id = ci.cart_id WHERE ci.product_id = '$product_id' AND c.user_id = '$userId'");
        return $query->fetch_array();
    }

    public function getCartItem($cart_itemId) {
        $query = mysqli_query($this->db, "select * from cart_item where id='$cart_itemId'");
        return $query->fetch_array();
    }

    public function getProduct($product_id) {
        $query = mysqli_query($this->db, "select * from products where id='$product_id'");
        return $query->fetch_array();
    }

    public function updateStock($product_id, $qty, $action) {
        if ($action == 'add') {
            mysqli_query($this->db, "update products set stock = stock + '$qty' where id = '$product_id';");
        } else {
            mysqli_query($this->db, "update products set stock = stock - '$qty' where id = '$product_id';");
        }
    }

    public function store($userId, $product_id, $qty) {
        $cartId = $this->checkCart($userId);
        $cartId = $cartId['id'];

        if (!$cartId) {
            mysqli_query($this->db, "insert into cart (user_id) values ('$userId');");
            $cartId = mysqli_insert_id($this->db);
        }

        $product = $this->getProduct($product_id);
        $subtotal = $product['price'] * $qty;

        $cart_item = $this->checkCartByProduct($product_id, $userId);

        if (!is_null($cart_item['id'])) {
            $cart_item_id = $cart_item['id'];
            mysqli_query($this->db, "update cart_item set qty = qty + '$qty', subtotal = subtotal + '$subtotal' where id = '$cart_item_id';");
        } else {
            mysqli_query($this->db, "insert into cart_item (cart_id,product_id,qty,subtotal) 
            values ('$cartId','$product_id','$qty','$subtotal')");
        }


        $this->updateStock($product_id, $qty, 'min');
    }

    public function delete_data($id) {
        $item = $this->getCartItem($id);

        $this->updateStock($item['product_id'], $item['qty'], 'add');

        mysqli_query($this->db, "delete from cart_item where id = '$id';");
    }

    public function get_carts($userId) {
        $query = mysqli_query($this->db,"SELECT ci.id, p.name, p.price, ci.qty, ci.subtotal FROM cart c 
                    JOIN cart_item ci ON c.id = ci.cart_id
                    JOIN products p ON ci.product_id = p.id WHERE c.user_id = '$userId';");
        $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
        return $data;
    }
}