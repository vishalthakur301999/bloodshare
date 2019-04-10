<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "da_ud";
$c=0;
session_start();
$ut = $_SESSION["ut"];
$conn = mysqli_connect($servername,$username,$password);
mysqli_select_db($conn,$db);
$fname=$lname=$email=$pass=$rpass="";
$uid = $_SESSION["loginid"];
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$Puname = $_SESSION["uname"];
$uname=$dob=$fname=$lname=$email=$pass=$utype="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $desorspc = test_input($_POST["desorspc"]);
    $desc = test_input($_POST["desc"]);
    $qty = test_input($_POST["qty"]);
}
$query = sprintf("update recieverdata set reason = '%s',desorspc = '%s',bquantity = '%s',filled=1 where rid = '$uid' ;",
        mysqli_real_escape_string($conn,$desc),
        mysqli_real_escape_string($conn,$desorspc),
        mysqli_real_escape_string($conn,$qty));

    $result = mysqli_query($conn,$query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error($conn));
    }
    header('Location:recieverhome.php');
?>