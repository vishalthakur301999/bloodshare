<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db = "da_ud";
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
};
mysqli_select_db($conn,$db);
if(isset($_POST['reject'])){
$uname = $_POST["uname"];
$pass = $_POST["pass"];

$sqld = "select * from donor where Uname='".$uname."' and pass='".$pass."'";
$sqlr = "select * from reciever where Uname='".$uname."' and pass='".$pass."'";
$result=mysqli_query($conn,$sqld);
if(mysqli_num_rows($result)==1)
{
    $_SESSION["uname"] = $uname;
    $_SESSION["pass"] = $pass;
    $_SESSION["ut"]="don";
    header('Location:donorhome.php');}
else{
    $result=mysqli_query($conn,$sqlr);
    if(mysqli_num_rows($result)==1)
    {
        $_SESSION["uname"] = $uname;
        $_SESSION["pass"] = $pass;
        $_SESSION["ut"]="rec";
        header('Location:recieverhome.php');
    }
    else{
        $message = "Invalid Credentials";
        echo "Invalid Credentials <A href='login.html'>Click Here to Go Back</A>";
        echo "<script>alert('$message');</script>";
    }
}}
/*$servername = "localhost";
$username = "id8780729_vishal";
$password = "qwerty@123";
$db = "id8780729_da_ud";*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css"/>
    <link rel="stylesheet" href="login.css">
    <title>Log in</title>
</head>
<body style="background-image:url('bg/p6_@2X.png');">
<header class="sans-serif">
    <nav class="dt w-100 mw-100 center nbg">
        <div class="dtc w2 v-mid pa3">
            <a class="f3 fw4 no-underline white dib ml2 pv2 ph3" href="index.html" >BloodShare</a>
        </div>
        <div class="dtc v-mid tr pa3">
            <a class="f6 dib white bg-animate hover-bg-white hover-black no-underline pv2 ph4 ba b--white-80" href="signup.html" >Sign Up</a>
        </div>
    </nav>
</header>
<div class="h3"></div>
<main class="pa4 sans-serif h-100">
    <form class="measure center" action="test.php" method="post">
        <fieldset id="sign_up" class="ba b--transparent ph0 mh0">
            <h1 class="f1">Sign in</h1>
            <div class="mt3">
                <label class="db fw6 lh-copy f6" for="uname">Username</label>
                <input class="pa2 input-reset ba bg-white hover-bg-black hover-white w-100" type="text" name="uname" id="uname" required>
            </div>
            <div class="mv3">
                <label class="db fw6 lh-copy f6" for="pass">Password</label>
                <input class="b pa2 input-reset ba bg-white hover-bg-black hover-white w-100" type="password" name="pass" id="pass" required>
            </div>
        </fieldset>
        <div>
            <input class="b ph3 pv2 input-reset ba b--black bg-transparent grow pointer f6 dib w-100" type="submit" value="Sign in">
        </div>
    </form>
</main>

</body>
</html>




























