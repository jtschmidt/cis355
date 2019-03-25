<?php
require "database.php";
if($_POST) {
    $success = false;
    $username = $_POST['username'];
    $password = $_POST['password_hash'];
    $sql = "SELECT * FROM customer WHERE email = '$username' AND password_hash = '$password'";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    
    if($success) {
        $_SESSION["username"] = $username;
        header("Location: customer.php?id=$sessionid ");
    }
        
    else {
        header("Location: login.php");
        exit();
    }
}
?>

<h1>Log in</h1>
<form class = "form-horizontal" action = "login.php" method = "post">

    <input name = "username" type = "text" placeholder = "youremail@email.com" required>
    <input name = "password" type = "password" required>
    <button type = "submit" class = "btn btn-success">Log In</button>
    <a href="signup.php" class = "btn btn-default">Join</a>
    
    <p style='color: red;'><?php echo $errorMessage; ?></p>
    
</form>