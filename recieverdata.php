<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db = "da_ud";
$conn = new mysqli($servername, $username, $password);
$loginuname = $_SESSION["uname"];
$loginpass = $_SESSION["pass"];
$ut = $_SESSION["ut"];
if(strcmp($ut,"rec")==0){
    $sqllogin = "select * from reciever where Uname = '$loginuname' and Pass = '$loginpass'";
    $link = "recieverhome";
    $data = "Receiver Details";
}
else if(strcmp($ut,"don")==0){
    $sqllogin = "select * from donor where Uname = '$loginuname' and Pass = '$loginpass'";
    $link = "donorhome";
    $data = "Donation History";
}
mysqli_select_db($conn,$db);
$r = mysqli_query($conn, $sqllogin);
if (mysqli_num_rows($r) > 0) {
    $lur = mysqli_fetch_assoc($r);
    $fname = $lur["Fname"];
    $lname = $lur["Lname"];
}
$loginid = $_SESSION["loginid"];
$sqlrdata = "select * from recieverdata where rid = '$loginid'";
$r2 = mysqli_query($conn, $sqlrdata);
if (mysqli_num_rows($r2) > 0) {
    $lur2 = mysqli_fetch_assoc($r2);
}
?>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="bic.png" />
    <title>Reciever Bio</title>
    <link href="signup.css" rel="stylesheet" type="text/css">
    <style>label{padding-top: 3%}</style>
</head>
<body style="background-image:url('stripes-light.png');">
<header class="sans-serif">
    <nav class="dt w-100 mw-100 center nbg">
        <div class="dtc w2 v-mid pa3">
            <a class="f3 fw4 no-underline white dib ml2 pv2 ph3" href="<?php echo "$link";?>.php" >BloodShare</a>
        </div>
        <div class="dtc v-mid tr pa3">
            <a class="f6 dib white bg-animate hover-bg-white hover-black no-underline pv2 ph4 ba b--white-80" href="<?php echo "$link";?>.php" >Cancel</a>
        </div>
    </nav>
</header>
<main class="pa4 sans-serif h-100">

    <form class="measure center" method="post" action="recieverdataprocess.php">
        <h1 class="f1">Reciever data</h1>
        <h4>This information will be shown on your profile.</h4>
                    <div class="mt3">
                        <label class="db fw6 lh-copy f6" for="firstname">Disease or Condition - </label>
                        <input class="pa2 input-reset ba bg-white hover-bg-black hover-white w-100" type="text" name="desorspc" value="<?php echo "$lur2[desorspc]";?>" required/></div>
                    <div class="mt3">
                        <label class="db fw6 lh-copy f6" for="lastname">Description (Not compulsory but recommended)</label>
                        <input type="text" class="pa2 input-reset ba bg-white hover-bg-black hover-white w-100" value="<?php echo "$lur2[reason]";?>" name="desc"></div>
                    <div class="mt3">
                        <label class="db fw6 lh-copy f6" for="username">Quantity Required</label>
                        <input class="pa2 input-reset ba bg-white hover-bg-black hover-white w-100" type="text" value="<?php echo "$lur2[bquantity]";?>" name="qty" required/></div>
                    <div class="mt3">
                        <input class="b ph3 pv2 input-reset ba b--black bg-transparent grow pointer f6 dib w-100" type="submit" value="Submit/Edit Data">
                    </div>
    </form>
</main>


</body>
</html>
