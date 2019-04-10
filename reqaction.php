<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db = "da_ud";
$c=0;
$conn = mysqli_connect($servername,$username,$password);
mysqli_select_db($conn,$db);
$loginuname = $_SESSION["uname"];
if(isset($_POST['accept'])){
    $id = $_POST["id"];
    $query = "update request set accept = 1, acceptedby = '$loginuname' where id= '$id'";
    $result = mysqli_query($conn,$query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error($conn));
    }
    header('Location:requests.php');
}
if(isset($_POST['reject'])){
    $id = $_POST["id"];
    $query = "update request set reject = 1,rejectedby = '$loginuname' where id= '$id'";
    $result = mysqli_query($conn,$query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error($conn));
    }
    header('Location:requests.php');
}
if(isset($_POST['cancel'])){
    $id = $_POST["id"];
    $query = "update request set reject = 1,rejectedby = '$loginuname' where id= '$id'";
    $result = mysqli_query($conn,$query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error($conn));
    }
    header('Location:requests.php');

}
?>