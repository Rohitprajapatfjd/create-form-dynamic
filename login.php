<?php session_start();
include ("./config.php");
if(isset($_POST['submit'])){
    $name = $_POST['username'];
    $pass = $_POST['password'];
   if($name=="Admin" && $pass == "admin123"){
   $_SESSION['id'] = "user";
   header("Location:./index.php");
   }else{
        $message = "Invalid Username And Password";
   }
}

if(isset($_SESSION['id'])){
    header("location:./index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>login Page</title>
</head>

<body>
    <div class="container">
        <div class="img">
            <img width="300" src="./img/4957136.jpg" alt="">
        </div>
        <div class="login">
            <h1>Log-In</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <div class="field">
                    <label class="label" for="Username">Username:</label>
                    <input type="text" placeholder="Username" name="username" id="username" required>
                </div>
                <div class="field">
                    <label class="label" for="Username">Password:</label>
                    <input type="Password" placeholder="Password" name="password" id="password" required>
                </div>
                <div class="field-check">
                    <span><input id="check" type="checkbox" required><label for="check">Remember</label></span>
                    <a class="anchar" href="">Forget Password</a>
                </div>
                <div class="btn-div">
                <button type="submit" name="submit" class="btn">Enter</button>
                </div>
                <div id="message"><?php if(isset($message)){
                    echo($message);
                } ?></div>
            </form>
        </div>
    </div>
</body>

</html>