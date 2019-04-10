<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db = "da_ud";
$c=0;
$conn = mysqli_connect($servername,$username,$password);
mysqli_select_db($conn,$db);
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$fromuname = test_input($_SESSION["uname"]);
$type = test_input($_POST["type"]);
$touname = test_input($_POST["uname"]);
echo $touname.$fromuname.$type;
$query = sprintf("insert into request" .
        " (requesteruname, requesteduname) " .
        " VALUES ('%s', '%s');",
        mysqli_real_escape_string($conn,$fromuname),
        mysqli_real_escape_string($conn,$touname));

    $result = mysqli_query($conn,$query);
    if (!$result) {
        die('Invalid query: ' . mysqli_error($conn));
    }
    header('Location:requests.php');


?>