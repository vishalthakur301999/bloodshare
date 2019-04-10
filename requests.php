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
mysqli_select_db($conn,$db);
$r = mysqli_query($conn, $sqllogin);
if (mysqli_num_rows($r) > 0) {
    $lur = mysqli_fetch_assoc($r);
    $fname = $lur["Fname"];
    $lname = $lur["Lname"];
}
?>
<HTML><HEAD>
    <TITLE>Connect Requests</TITLE>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="bic.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="donorhome.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style>
        .btn-space {
            margin-right: 5px;
        }
    </style>
</HEAD><body style="background-image:url('stripes-light.png');">
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
        <a style="padding: 0.5%">
        <div class="card"><div class="card-body">
        <div><h5 style="padding: 2%;font-family: 'Roboto', sans-serif;">Successful Connect Requests</h5></div>
                <div><h6 style="padding: 2%;font-family: 'Roboto', sans-serif;">Connect requests accepted by requested user</h6></div>
        <?php
        $conn = new mysqli($servername, $username, $password);
        mysqli_select_db($conn,$db);
        $qsuccess = "select * from request where requesteruname='$loginuname' and accept=1 and reject=0";
        $result = mysqli_query($conn, $qsuccess);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='card'><div class='card-body'><div class='container'><div class='row'>";
                echo "<div class='col-sm'>Requested by $row[requesteruname] on $row[dateofreq] </div>";
                echo "<div class='col-sm'>accepted by $row[acceptedby]</div><div class='col-sm'>";
                echo "<form action='contactdetails.php' method='post'><input type='hidden' name='id' value='$row[id]'><input type='hidden' name='accepteduname' value='$row[requesteruname]'>";
                echo "<input type='hidden' name='acceptoruname' value='$row[requesteduname]'>";
                echo "<button type='submit' name='vpf' class='btn btn-success btn-space' style='width: 100%'>View Contact Details</button></form>";
                echo "</div></div></div></div></div>";
            }
        } else {
            echo "<h6 style='text-align: center'>0 results</h6>";
        }
        ?>
        <div><h6 style="padding: 2%;font-family: 'Roboto', sans-serif;">Connect requests accepted by you</h6></div>
        <?php
        $conn = new mysqli($servername, $username, $password);
        mysqli_select_db($conn,$db);
        $qsuccess = "select * from request where requesteduname='$loginuname' and accept=1 and reject=0";
        $result = mysqli_query($conn, $qsuccess);
        if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                  echo "<div class='card'><div class='card-body'><div class='container'><div class='row'>";
                  echo "<div class='col-sm'>Requested by $row[requesteruname] on $row[dateofreq] </div>";
                  echo "<div class='col-sm'>accepted by $row[acceptedby]</div><div class='col-sm'>";
                  echo "<form action='contactdetails.php' method='post'><input type='hidden' name='id' value='$row[id]'><input type='hidden' name='accepteduname' value='$row[requesteruname]'>";
                  echo "<input type='hidden' name='acceptoruname' value='$row[requesteduname]'>";
                  echo "<button type='submit' name='vpf' class='btn btn-success btn-space' style='width: 100%'>View Contact Details</button></form>";
                  echo "</div></div></div></div></div>";
              }
        } else {
              echo "<h6 style='text-align: center'>0 results</h6>";
        }
        ?>
            </div></div>
        <a style="padding: 0.5%"><div class="card"><div class="card-body">
        <div><h5 style="padding: 2%;font-family: 'Roboto', sans-serif;">Connect Requests Received</h5></div>
        <?php
        $conn = new mysqli($servername, $username, $password);
        mysqli_select_db($conn,$db);
        $qsuccess = "select * from request where requesteduname='$loginuname' and accept=0 and reject=0";
        $result = mysqli_query($conn, $qsuccess);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='card'><div class='card-body'><div class='container'><div class='row'>";
                echo "<div class='col-sm'>Request from "."$row[requesteruname]"." on "."$row[dateofreq]</div>";
                echo "<div class='col-sm'></div><div class='col-sm'><table style='width: 100%'><tr>";
                echo "<td><form action='reqaction.php' method='post'><input type='hidden' name='acceptuname' value='$row[requesteruname]'>";
                echo "<input type='hidden' value='$row[id]' name='id'>";
                echo "<button type='submit' class='btn btn-success btn-space' name='accept' style='width: 95%'>Accept</button></form></td>";
                echo "<td><form action='reqaction.php' method='post'><input type='hidden' name='rejectuname' value='$row[requesteruname]'>";
                echo "<input type='hidden' value='$row[id]' name='id'>";
                echo "<button type='submit' class='btn btn-danger btn-space' name='reject' style='width: 95%'>Reject</button></form></td>";
                echo "</tr></table></div></div></div></div></div>";
            }
        } else {
            echo "<h6 style='text-align: center'>0 results</h6>";
        }
        ?>
        </div></div><a style="padding: 0.5%">
        <div class="card"><div class="card-body">
        <div><h5 style="padding: 2%;font-family: 'Roboto', sans-serif;">Connect Requests Sent</h5></div>
        <?php
        $conn = new mysqli($servername, $username, $password);
        mysqli_select_db($conn,$db);
        $qsuccess = "select * from request where requesteruname='$loginuname' and accept=0 and reject=0";
        $result = mysqli_query($conn, $qsuccess);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='card'><div class='card-body'><div class='container'><div class='row'>";
                echo "<div class='col-sm'>Request Sent to "."$row[requesteduname]"." on $row[dateofreq]</div>";
                echo "<div class='col-sm'></div><div class='col-sm'>";
                echo "<form action='reqaction.php' method='post'><input type='hidden' name='id' value='$row[id]'><input type='hidden' name='rejectuname' value='$row[requesteruname]'>";
                echo "<button type='submit' name='cancel' class='btn btn-danger btn-space' style='width: 100%'>Cancel</button></form>";
                echo "</div></div></div></div></div>";
            }
        } else {
            echo "<h6 style='text-align: center'>0 results</h6>";
        }
        ?>
        </div></div>
        <a style="padding: 0.5%"><div class="card"><div class="card-body">
        <div><h5 style="padding: 2%;font-family: 'Roboto', sans-serif;">Connect Requests Rejected / Cancelled</h5></div>
        <div><h6 style="padding: 2%;font-family: 'Roboto', sans-serif;">Connect requests rejected by you</h6></div>
        <?php
        $conn = new mysqli($servername, $username, $password);
        mysqli_select_db($conn,$db);
        $qsuccess = "select * from request where requesteduname='$loginuname' and accept=0 and reject=1";
        $result = mysqli_query($conn, $qsuccess);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='card'><div class=\"card-body\">";
                echo "Rejected request of $row[requesteruname] on $row[dateofreq]";
                echo "</div></div>";
            }
        } else {
            echo "<h6 style='text-align: center'>0 results</h6>";
        }
        ?>

        <div><h6 style="padding: 2%;font-family: 'Roboto', sans-serif;">Connect requests Rejected</h6></div>
        <?php
        $conn = new mysqli($servername, $username, $password);
        mysqli_select_db($conn,$db);
        $qsuccess = "select * from request where requesteruname='$loginuname' and accept=0 and reject=1";
        $result = mysqli_query($conn, $qsuccess);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='card'><div class=\"card-body\">";
                echo "Request rejected by $row[requesteduname] on $row[dateofreq]";
                echo "</div></div>";
            }
        } else {
            echo "<h6 style='text-align: center'>0 results</h6>";
        }
        ?>
        </div></div><a style="padding: 0.5%">
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
