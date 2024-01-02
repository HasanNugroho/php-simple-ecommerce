<?php
require('./koneksi.php');
class User{
    private $db;
    public function __construct() {
        $conn = new database();
        $this->db = $conn->conn();
    }
    public function registerUser($username, $password, $name, $nim) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO users (username, password, name, nim) VALUES ('".$username."', '".$hashedPassword."', '".$name."','".$nim."')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function userExist($username, $nim) {
        $sql = "SELECT id, username, password FROM users WHERE username = '".$username."' AND nim = '".$nim."'";
        $result = $this->db->query($sql);
    
        if ($result->num_rows > 0) {
            return false;
        }
        return true;
    }

    public function validateUser($username, $password) {
        $sql = "SELECT id, username, password FROM users WHERE username = '".$username."'";
        $result = $this->db->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            if (password_verify($password, $row['password'])) {
                return $row['id'];
            }
        }
        return false;
    }
}