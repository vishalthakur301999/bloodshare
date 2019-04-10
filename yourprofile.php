<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db = "da_ud";
$conn = new mysqli($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_select_db($conn,$db);
$loginuname = $_SESSION["uname"];
$loginpass = $_SESSION["pass"];
$ut = $_SESSION["ut"];
if(strcmp($ut,"rec")==0){
    $sqllogin = "select * from reciever where Uname = '$loginuname' and Pass = '$loginpass'";
    $link = "recieverhome";
    $data = "Receiver Details";
    $dataurl = "recieverdata.php";
}
else if(strcmp($ut,"don")==0){
    $sqllogin = "select * from donor where Uname = '$loginuname' and Pass = '$loginpass'";
    $link = "donorhome";
    $data = "Donation History";
    $dataurl = "donorhistory.php";
}
$ru = mysqli_query($conn, $sqllogin);
if (mysqli_num_rows($ru) > 0) {
    $row = mysqli_fetch_assoc($ru);
    $rid = $row["ID"];
    $fname = $row["Fname"];
    $lname = $row["Lname"];
}
$loginid = $_SESSION["loginid"];
$sqlrdata = "select * from recieverdata where rid = '$loginid'";
$r2 = mysqli_query($conn, $sqlrdata);
if (mysqli_num_rows($r2) > 0) {
    $lur2 = mysqli_fetch_assoc($r2);
}
$sqlddata = "select * from donorhistory where did = '$rid'";
$d2 = mysqli_query($conn, $sqlddata);
if (mysqli_num_rows($d2) > 0) {
    $lud2 = mysqli_fetch_assoc($d2);
}
?>
<HTML><HEAD>
    <TITLE>Your Profile</TITLE>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="bic.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="test.css" rel="stylesheet" type="text/css">
</HEAD><body style="background-image:url('bg/p6_@2X.png');">
<nav class="navbar navbar-expand-lg navbar-dark nbg">
    <a class="navbar-brand" href="<?php echo "$link";?>.php">BloodShare</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hello <?php echo "$fname"." "."$lname";?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="profileedit.php">Account Settings</a>
                    <a class="dropdown-item" href="<?php echo $dataurl;?>"><?php echo $data;?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Your Profile</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="requests.php">Your Connect Requests</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="signout.php">
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Sign Out</button>
        </form>
    </div>
</nav>
<h1 align="center" style="padding: 2%;">Your Profile</h1>
<main>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered"><tr>
                        <td>Name</td><td><?php echo $row["Fname"]." ".$row["Lname"];?></td></tr>
                    <?php
                    if(strcmp($ut,"rec")==0){
                        echo "<tr><td>Blood Group Required</td><td>".$row["bloodgroup"]."</td></tr>";
                        echo "<tr><td>Disease / Special Condition</td><td>".$lur2["desorspc"]."</td></tr>";
                        echo "<tr><td>Description</td><td>".$lur2["reason"]."</td></tr>";
                        echo "<tr><td>Quantity required</td><td>".$lur2["bquantity"]."</td></tr>";
                        echo "<tr><td>Locality and City</td><td>".$row["Locality"].",".$row["City"]."</td></tr>";
                    }
                    else if(strcmp($ut,"don")==0){
                        echo "<tr><td>Blood Group Available</td><td>".$row["bloodgroup"]."</td></tr>";
                        echo "<tr><td>Locality and City</td><td>".$row["Locality"]." ,".$row["City"]."</td></tr>";
                        echo "<tr><td>No. of previous donations</td><td>".$lud2["nofdon"]."</td></tr>";
                    }
                    ?>
                </table>
                <form action="<?php echo "$link";?>.php" method="post">
                    <input type="submit" class="btn btn-success" value="Go Back">
                </form>

            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</BODY></HTML>




