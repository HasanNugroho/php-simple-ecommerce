<?php
class database{
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "ecommerce";
    var $koneksi = "";

    public function conn() {
        $koneksi = mysqli_connect($this->host, $this->username, $this->password,$this->database);
        if (mysqli_connect_errno()){
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
        return $koneksi;
    }
}
?>