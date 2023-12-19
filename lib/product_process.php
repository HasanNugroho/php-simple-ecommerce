<?php
session_start();
require('../koneksi.php');
    function store($conn,$code,$name,$price,$stock,$description,$userId) {
        mysqli_query($conn, "insert into products (code,name,price,stock,description,user_id) 
        values ('$code','$name','$price','$stock','$description','$userId');");
    }

    function update_data($conn,$id,$code,$name,$price,$stock,$description,$userId){
        mysqli_query($conn, "update products set code = '$code', name = '$name',
        price = '$price', stock = '$stock', description = '$description' where id = '$id' and user_id = '$userId';");
    }

    function delete_data($conn, $id, $userId) {
        mysqli_query($conn, "delete from products where id = '$id' and user_id = '$userId';");
    }

    $action = $_GET['action'];
    if ($action == 'add') {
        store($conn,
                $_POST['code'],
                $_POST['name'],
                $_POST['price'],
                $_POST['stock'],
                $_POST['description'],
                $_SESSION['user_id'],
                );
        header('location: ../product_list.php');
    } elseif ($action == 'update') {
        update_data($conn,
                $_POST['id'],
                $_POST['code'],
                $_POST['name'],
                $_POST['price'],
                $_POST['stock'],
                $_POST['description'],
                $_SESSION['user_id']);
        header('location: ../product_list.php');
    } elseif ($action == 'delete') {
        $id = $_GET['x'];
        delete_data($conn, $id, $_SESSION['user_id']);
        header('location: ../product_list.php');
    }
?>