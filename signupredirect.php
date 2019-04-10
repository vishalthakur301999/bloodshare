<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "da_ud";
$c=0;
$conn = mysqli_connect($servername,$username,$password);
mysqli_select_db($conn,$db);
$fname=$lname=$email=$pass=$rpass="";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$uname=$dob=$fname=$lname=$email=$pass=$utype="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fname = test_input($_POST["firstname"]);
  $lname = test_input($_POST["lastname"]);
  $uname = test_input($_POST["username"]);
  $email = test_input($_POST["email"]);
  $dob = test_input($_POST["dob"]);
  $pass = test_input($_POST["pass"]);
  $rpass = test_input($_POST["rpass"]);
  $rdb = test_input($_POST["rdb"]);
  $mobile = test_input($_POST["mobile"]);
  $utype= test_input($_POST["rdb"]);
  $lat = test_input($_POST['lat']);
  $lng = test_input($_POST['long']);
  $type = test_input($_POST['value']);
  $bg = test_input($_POST['bg']);
  $address = test_input($_POST['Address']);
  $locality = test_input($_POST['Locality']);
  $city = test_input($_POST['city']);
}
if(strcmp($utype,"donor")==0){
$query = sprintf("insert into donor" .
         " (Lname, Fname, Uname, Pass, mobile ,email,dob,bloodgroup,address,locality,City,address_type,lat,lng) " .
         " VALUES ('%s', '%s', '%s', '%s','%s' ,'%s','%s','%s','%s','%s','%s','%s','%f','%f');",
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
         mysqli_real_escape_string($conn,$lng));

$result = mysqli_query($conn,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($conn));
}
header('Location:signupsuccess.html');}
elseif(strcmp($utype,"reciever")==0){
$query = sprintf("insert into reciever" .
         " (Lname, Fname, Uname, Pass, mobile ,email,dob,bloodgroup,address,locality,City,Address_Type,lat,lng) " .
                  " VALUES ('%s', '%s', '%s', '%s','%s','%s' ,'%s','%s','%s','%s','%s','%s','%f','%f');",
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
                  mysqli_real_escape_string($conn,$lng));
$result = mysqli_query($conn,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error($conn));
}
header('Location:signupsuccess.html');
}

?>