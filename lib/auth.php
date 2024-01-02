<?php
session_start();

require('./User.php');

$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $userId = $user->validateUser($username, $password);
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
        $name = $_POST["name"];
        $nim = $_POST["nim"];
        $password = $_POST["password"];
        $c_password = $_POST["c_password"];

        if ($user->userExist($username, $nim)){
            if ($password === $c_password) {
                if ($user->registerUser($username, $password, $name, $nim)) {
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