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
$url = "https://ussouthcentral.services.azureml.net/workspaces/b8acb61c23b4451ab7772f3bd8b0eb6a/services/018ab0310e024b4b92f7bd1f5f30f971/execute?api-version=2.0&format=swagger";
$api_key = 'DyZV3KZMwsfilxC4vzHTy8oK16a8B2CI48gCtQtY94yuxX4IcmzE/58RFG6r5xC5rSNwTzz5ZiNowG0amyD0Mg==';
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