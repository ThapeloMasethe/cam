<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/login.css" />
    <script src="main.js"></script>
</head>
<body>
<form action="users.php" method="POST">
        Email: <input type="email" name="email"> <br>
        Password: <input type="password" name="password"> <br>
        <input type="hidden" name="login" value="login">
        <button type="submit">login</button>
    </form>
</body>
</html>