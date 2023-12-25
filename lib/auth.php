<?php
session_start();
require('../koneksi.php');


function userExist($username, $conn) {
    $sql = "SELECT id, username, password FROM users WHERE username = '".$username."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return false;
    }
    return true;
}

function validateUser($username, $password, $conn) {
    $sql = "SELECT id, username, password FROM users WHERE username = '".$username."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['password'])) {
            return $row['id'];
        }
    }
    echo $username;
    return false;
}

function registerUser($username, $password, $conn) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('".$username."', '".$hashedPassword."')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $userId = validateUser($username, $password, $conn);
        if ($userId !== false) {
            $_SESSION["user_id"] = $userId;
            $_SESSION["username"] = $username;
            setcookie("message","delete",time()+3600);

            header("Location: ../index.php");
        } else {
            ?>
            <script language="JavaScript">
                alert('Username atau Password tidak sesuai. Silahkan diulang kembali!');
                document.location='../login.php';
            </script>
            <?php
        }
    } elseif (isset($_POST["register"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $c_password = $_POST["c_password"];

        if (userExist($username,$conn)){
            if ($password === $c_password) {
                if (registerUser($username, $password, $conn)) {
                    header("Location: ../login.php");
                    exit();
                } else {
                    ?>
                    <script language="JavaScript">
                        alert('Registrasi gagal. Silahkan diulang kembali!');
                        document.location='../register.php';
                    </script>
                    <?php
                }
            } else {
                ?>
                <script language="JavaScript">
                    alert('Password dan konfirmasi password tidak sama. Silahkan diulang kembali!');
                    document.location='../register.php';
                </script>
                <?php
            }
        } else {
            ?>
            <script language="JavaScript">
                alert('Username sudah ada');
                document.location='../register.php';
            </script>
            <?php
        }
    }
}

$conn->close();
?>