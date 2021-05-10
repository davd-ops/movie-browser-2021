<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" type="text/javascript"></script>
    <title>Login | Film storage</title>
</head>
<body>
<?php
require_once('db.php');
session_start();
// When form submitted, check and create user session.
if (isset($_POST['username'])) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $sql = 'SELECT * FROM users WHERE username = :username && password = :password';
    $statement = $pdo->prepare($sql);
    $statement->execute(['username' => $username, 'password' => md5($password)]);
    $user = $statement->fetch();

    if (isset($user->username)) {
        $_SESSION['username'] = $username;
        // Redirect to user dashboard page
        header("Location: index.php");
    } else {
        echo "
                <div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                </div>
             ";
    }

} else {
    ?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true" required/>
        <input type="password" class="login-input" name="password" placeholder="Password" required/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="registration.php">New Registration</a></p>
    </form>
    <?php
}
?>
</body>
</html>