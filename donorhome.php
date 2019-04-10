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
$sqllogin = "select * from donor where Uname = '$loginuname' and Pass = '$loginpass'";
mysqli_select_db($conn,$db);

$r = mysqli_query($conn, $sqllogin);
if (mysqli_num_rows($r) > 0) {
    $loginuserrow = mysqli_fetch_assoc($r);
    $fname = $loginuserrow["Fname"];
    $lname = $loginuserrow["Lname"];
    $ulat = $loginuserrow["LAT"];
    $ulon = $loginuserrow["LNG"];
    $bg = $loginuserrow["bloodgroup"];
    $_SESSION["loginid"] = $loginuserrow["ID"];
    $id = $loginuserrow["ID"];
}
$sqldata = "select * from donorhistory where did = '$id'";
$r2 = mysqli_query($conn, $sqldata);
if(mysqli_num_rows($r2)==0){
    $q3="INSERT INTO `donorhistory`(`did`, `lastdon`, `nofdon`, `firstdon`, `prediction`, `filled`) VALUES ($id,0,0,0,0,0)";
    $r3 = mysqli_query($conn, $q3);
    header('Location:donorhistory.php');
}
?>
<HTML><HEAD>
    <TITLE>Donate Blood</TITLE>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="bic.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="donorhome.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</HEAD><body style="background-image:url('stripes-light.png');">
<nav class="navbar navbar-expand-lg navbar-dark nbg">
    <a class="navbar-brand" href="donorhome.php">BloodShare</a>
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
                    <a class="dropdown-item" href="donorhistory.php">Donation History</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="yourprofile.php">Your Profile</a>
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

<main>
    <div class="container">
        <div><h1 style="padding: 2%;font-family: 'Roboto', sans-serif;">List of current requests</h1></div>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "da_ud";
        $conn = new mysqli($servername, $username, $password);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $miles = 10;
        mysqli_select_db($conn,$db);
        $sql = "SELECT *, 
        ( 3959 * acos( cos( radians('$ulat') ) * 
        cos( radians( LAT ) ) * 
        cos( radians( LNG ) - 
        radians('$ulon') ) + 
        sin( radians('$ulat') ) * 
        sin( radians( LAT ) ) ) ) 
        AS distance FROM reciever HAVING distance < '$miles' and bloodgroup like '$bg' ORDER BY distance ASC LIMIT 0, 5";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='card'><div class='card-body'><div class='container'><form method='post' action='profile.php'>";
                echo "<h3>$row[Fname] $row[Lname]</h3><hr width='95%'>";
                echo "<div class='row'><div class='col-sm'>Blood Group - $row[bloodgroup]</div>";
                echo "<div class='col-sm'>Locality - $row[Locality], $row[City]</div><div class='col-sm'>";
                echo "<input type='hidden' name='type' value='don'>";
                echo "<input type='hidden' name='uname' value='".$row["Uname"]."'><input type='submit' value='View Profile' class='btn btn-dark'>";
                echo "</form></div></div></div></div></div><a style=\"padding: 0.5%\">";
            }
        } else {
            echo "0 results";
        }
        if (!$result) {
            die('Invalid query: ' . mysqli_error($conn));
        }
        mysqli_close($conn);
        ?>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</BODY></HTML>




