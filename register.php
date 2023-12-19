<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- You can also include your custom CSS file here -->
</head>
<body>
    <form action="./lib/auth.php" method="post">
        <h1>Register</h1>
        <label for="username">Username : </label><br>
        <input type="text" name="username" id="username"><br><br>
        
        <label for="password">Password : </label><br>
        <input type="password" name="password" id="password"><br><br>
        <label for="c_password">Confrim Password : </label><br>
        <input type="password" name="c_password" id="c_password"><br><br>

        <button type="submit" name="register">Register</button>
    </form>
</body>
</html>