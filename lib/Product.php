<?php
require_once(__DIR__ . '\koneksi.php');

class Product{
    private $db;
    public function __construct() {
        $conn = new database();
        $this->db = $conn->conn();
    }
    function __destruct() {
        mysqli_close($this->db);
    }

    public function get_public_products(){
        $query = mysqli_query($this->db, "SELECT * FROM products");
        $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
        return $data;
    }
    public function get_private_products($userId){
        $query = mysqli_query($this->db, "SELECT * FROM products where user_id = '$userId'");
        $data = mysqli_fetch_all($query, MYSQLI_ASSOC);
        return $data;
    }

    public function get_product_private_byId($userId, $id){
        $query = mysqli_query($this->db, "select * from products where id='$id' and user_id = '$userId'");
        $data = $query->fetch_array();
        return $data;
    }
    public function get_product_public_byId($id){
        $query = mysqli_query($this->db, "select * from products where id='$id'");
        $data = $query->fetch_array();
        return $data;
    }
    public function store($code,$name,$price,$stock,$description,$userId) {
        mysqli_query($this->db, "insert into products (code,name,price,stock,description,user_id) 
        values ('$code','$name','$price','$stock','$description','$userId');");
    }

    public function update_data($id,$code,$name,$price,$stock,$description,$userId){
        mysqli_query($this->db, "update products set code = '$code', name = '$name',
        price = '$price', stock = '$stock', description = '$description' where id = '$id' and user_id = '$userId';");
    }

    public function delete_data($id, $userId) {
        mysqli_query($this->db, "delete from products where id = '$id' and user_id = '$userId';");
    }
}