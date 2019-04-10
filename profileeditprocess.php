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
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$Puname = $_SESSION["uname"];
$uname=$dob=$fname=$lname=$email=$pass=$utype="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = test_input($_POST["firstname"]);
    $lname = test_input($_POST["lastname"]);
    $uname = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $dob = test_input($_POST["dob"]);
    $pass = test_input($_POST["pass"]);
    $rpass = test_input($_POST["rpass"]);
    $mobile = test_input($_POST["mobile"]);
    $lat = test_input($_POST['lat']);
    $lng = test_input($_POST['long']);
    $type = test_input($_POST['value']);
    $bg = test_input($_POST['bg']);
    $address = test_input($_POST['Address']);
    $locality = test_input($_POST['Locality']);
    $city = test_input($_POST['city']);
}
if(strcmp($ut,"don")==0){
    $query = sprintf("update donor set Lname = '%s',Fname = '%s',Uname = '%s',pass = '%s',mobile = '%s',email = '%s',dob ='%s',bloodgroup = '%s',
              address = '%s',locality = '%s',City = '%s',Address_Type = '%s',lat = '%f',lng = '%f' where Uname = '%s';",
        mysqli_real_escape_string($conn,$lname),
        mysqli_real_escape_string($conn,$fname),
        mysqli_real_escape_string($conn,$uname),
        mysqli_real_escape_string($conn,$pass),
        mysqli_real_escape_string($conn,$mobile),
        mysqli_real_escape_string($conn,$email),
        mysqli_real_escape_string($conn,$dob),
        mysqli_real_escape_string($conn,$bg),
        mysqli_real_escape_string($conn,$address),
        mysqli_real_escape_string($conn,$locality),
        mysqli_real_escape_string($conn,$city),
        mysqli_real_escape_string($conn,$type),
        mysqli_real_escape_string($conn,$lat),
        mysqli_real_escape_string($conn,$lng),
        mysqli_real_escape_string($conn,$Puname));
    $result = mysqli_query($conn,$query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error($conn));
    }
    header('Location:donorhome.php');}
elseif(strcmp($ut,"rec")==0){
    $query = sprintf("update reciever set Lname = '%s',Fname = '%s',Uname = '%s',pass = '%s',mobile = '%s',email = '%s',dob ='%s',bloodgroup = '%s',
              address = '%s',locality = '%s',City = '%s',Address_Type = '%s',lat = '%f',lng = '%f' where Uname = '%s';",
        mysqli_real_escape_string($conn,$lname),
        mysqli_real_escape_string($conn,$fname),
        mysqli_real_escape_string($conn,$uname),
        mysqli_real_escape_string($conn,$pass),
        mysqli_real_escape_string($conn,$mobile),
        mysqli_real_escape_string($conn,$email),
        mysqli_real_escape_string($conn,$dob),
        mysqli_real_escape_string($conn,$bg),
        mysqli_real_escape_string($conn,$address),
        mysqli_real_escape_string($conn,$locality),
        mysqli_real_escape_string($conn,$city),
        mysqli_real_escape_string($conn,$type),
        mysqli_real_escape_string($conn,$lat),
        mysqli_real_escape_string($conn,$lng),
        mysqli_real_escape_string($conn,$Puname));
    $result = mysqli_query($conn,$query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error($conn));
    }
    header('Location:recieverhome.html');
}

?>