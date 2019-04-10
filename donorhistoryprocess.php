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
    $lastdon = test_input($_POST["lastdon"]);
    $nofdon = test_input($_POST["nofdon"]);
    $firstdon = test_input($_POST["firstdon"]);
}
$firstdon = (2019-$firstdon)*12;
error_reporting(E_ALL);
ini_set('display_errors', 1);
$url = "Your Azure ML Api URL";
$api_key = 'Your Azure ML Api key';
$data = array(
    'Inputs'=> array(
        'input1'=> [array(
            'Recency' => $lastdon,
            'Frequency' => $nofdon,
            'Monetary' => 0,
            'Time' => $firstdon,
            'Class' => 0,

        ),]
    ),
    'GlobalParameters' => null
);
$body = json_encode($data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$api_key, 'Accept: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response  = json_decode(curl_exec($ch), true);
//echo 'Curl error: ' . curl_error($ch);
curl_close($ch);
foreach($response as $don){
    foreach ($don as $don2){
        foreach ($don2 as $don3){
            $ml =  $don3['Scored Probabilities for Class "1"'];
        }
    }
}
$query = sprintf("update donorhistory set lastdon = '%s',nofdon = '%s',firstdon = '%s',prediction = $ml,filled=1 where did = '$uid' ;",
    mysqli_real_escape_string($conn,$lastdon),
    mysqli_real_escape_string($conn,$nofdon),
    mysqli_real_escape_string($conn,$firstdon));

$result = mysqli_query($conn,$query);
if (!$result) {
    die('Invalid query: ' . mysqli_error($conn));
}
header('Location:donorhome.php');
?>