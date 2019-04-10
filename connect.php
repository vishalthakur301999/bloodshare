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
}
?>
