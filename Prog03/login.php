<?php
session_start();
require "../Prog03/database.php";

if ($_GET)
	$errorMessage = $_GET["errorMessage"];
else
	$errorMessage = '';

if($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	

    $sql = "SELECT * FROM customer WHERE email = '$username' AND password_hash = '$password' LIMIT 1";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);    

    if($data) {
        $_SESSION["username"] = $username;
        header("Location: customer.php");
    }
        
    else {
        header("Location: login.php?errorMessage=Invalid");
        exit();
    }
}
?>

<h1>Log in</h1>
<form class = "form-horizontal" action = "login.php" method = "post">

    <input name = "username" type = "text" placeholder = "youremail@email.com" required>
    <input name = "password" type = "password" required>
    <button type = "submit" class = "btn btn-success">Log In</button>
    <a href="signup.php" class = "btn btn-default">Sign Up</a>
    
    <p style='color: red;'><?php echo $errorMessage; ?></p>
    
</form>