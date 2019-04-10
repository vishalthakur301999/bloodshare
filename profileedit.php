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
?>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="bic.png" />
    <title>Edit Profile</title>
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
    <form class="measure center" method="post" action="profileeditprocess.php">
        <h1 class="f1">Edit Profile</h1>
        <div class="outer" style="padding-top: 50px;padding-bottom: 50px">
            <div class="middle">
                <div class="inner">
                    <div class="mt3">
                        <label class="db fw6 lh-copy f6" for="firstname">First Name</label>
                        <input class="pa2 input-reset ba bg-transparent hover-bg-black hover-white w-100" type="text" name="firstname" pattern="^[a-ZA-Z]$" id="firstname" value="<?php echo "$lur[Fname]";?>" required/></div>
                    <div class="mt3">
                        <label class="db fw6 lh-copy f6" for="lastname">Last Name</label>
                        <input class="pa2 input-reset ba bg-transparent hover-bg-black hover-white w-100" type="text" name="lastname" id="lastname" pattern="^[a-ZA-Z]$" value="<?php echo "$lur[Lname]";?>" required/></div>
                    <div class="mt3">
                        <label class="db fw6 lh-copy f6" for="username">Username</label>
                        <input class="pa2 input-reset ba bg-transparent hover-bg-black hover-white w-100" type="text" name="username" id="username" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" value="<?php echo "$lur[Uname]";?>" required/></div>
                    <div class="mt3">
                        <label class="db fw6 lh-copy f6" for="mobile">Mobile Number</label>
                        <input class="pa2 input-reset ba bg-transparent hover-bg-black hover-white w-100" type="text" name="mobile" id="mobile" value="<?php echo "$lur[mobile]";?>" required/></div>
                    <div class="mt3">
                        <label class="db fw6 lh-copy f6" for="email">Email Address</label>
                        <input class="pa2 input-reset ba bg-transparent hover-bg-black hover-white w-100" type="email" name="email" id="email" value="<?php echo "$lur[email]";?>" required/></div>
                    <div class="mt3">
                        <label class="db fw6 lh-copy f6" for="dob">Date of Birth</label>
                        <input class="pa2 input-reset ba bg-transparent hover-bg-black hover-white w-100" type="date" name="dob" id="dob" value="<?php echo "$lur[dob]";?>" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" required/>
                    </div>
                    <div class="mt3">
                        <label class="db fw6 lh-copy f6" for="pass">Password</label>
                        <input class="pa2 input-reset ba bg-transparent hover-bg-black hover-white w-100" type="password" name="pass" id="pass" value="<?php echo "$lur[pass]";?>" required/></div>
                    <div class="mt3">
                        <label class="db fw6 lh-copy f6" for="rpass">Repeat Password</label>
                        <input class="pa2 input-reset ba bg-transparent hover-bg-black hover-white w-100" type="password" name="rpass" id="rpass" value="<?php echo "$lur[pass]";?>" required oninput="check(this)"/><br></div>
                    <script language='javascript' type='text/javascript'>
                        function check(input) {
                            if (input.value != document.getElementById('pass').value) {
                                input.setCustomValidity('Password Must be Matching.');
                            } else {
                                input.setCustomValidity('');
                            }
                        }
                    </script>


                </div>
            </div>
        </div>
        <div class="mt3">
            <h4 id="h1c" style="text-align: center">Select Your Location on the Map Below</h4>
            <h2id="h1c" style="text-align: center">This map only stores your approximate coordinates, which helps us find the people closest to you.</h2></div>
        <div id="map" style="width: 100%;height: 500px"></div>
        <div id="ftable">
            <button type="button" value='Save Location' class="b ph3 pv2 input-reset ba b--black bg-transparent grow pointer f6 dib w-100" style="width: 100%" onclick='saveData()'>Save Location</button><br>
            <p id="p1">Location data not yet saved.</p>
            <div class="mt3">
                <label class="db fw6 lh-copy f6" for="bg">Select Your Blood Group</label>
                <select class="pa2 ba bg-transparent w-100" id='bg' name="bg" id="bg" >
                    <option value='A+'>A+</option>
                    <option value='O+'>O+</option>
                    <option value='B+'>B+</option>
                    <option value='AB+'>AB+</option>
                    <option value='A-'>A-</option>
                    <option value='O-'>O-</option>
                    <option value='B-'>B-</option>
                    <option value='AB-'>AB-</option>
                </select>
            </div>
            <div class="mt3">
                <label class="db fw6 lh-copy f6" for="Address" >Address</label>
                <input type='text' class="pa2 input-reset ba bg-transparent hover-bg-black hover-white w-100" id='Address' name="Address" value="<?php echo "$lur[Address]";?>" required/>
            </div>
            <div class="mt3">
                <label class="db fw6 lh-copy f6" for="Locality">Locality</label>
                <input type='text' class="pa2 input-reset ba bg-transparent hover-bg-black hover-white w-100" id='Locality' name="Locality" value="<?php echo "$lur[Locality]";?>" required/>
            </div>
            <div class="mt3">
                <label class="db fw6 lh-copy f6" for="City">City</label>
                <input type='text' class="pa2 input-reset ba bg-transparent hover-bg-black hover-white w-100" id='City' name="city" value="<?php echo "$lur[City]";?>" required/>
            </div>
            <div class="mt3">
                <label class="db fw6 lh-copy f6" for="type">Address Type</label>
                <select class="pa2 ba bg-transparent w-100" id='type' name="value">
                    <option value='Home'>Home</option>
                    <option value='Work'>Work</option>
                </select><br>
            </div>
            <input type="hidden" name="lat" id="elat" value="">
            <input type="hidden" name="long" id="elong" value="">

            <br><button class="b ph3 pv2 input-reset ba b--black bg-transparent grow pointer f6 dib w-100" type="submit" style="width: 100%">Save Changes</button>
        </div>
        <div class="h3"></div>
    </form>
</main>
<script>
    document.getElementById("bg").value = "<?php echo "$lur[bloodgroup]";?>";
    document.getElementById("type").value = "<?php echo "$lur[Address_Type]";?>";

</script>
<script>
    var map;
    var marker;
    var infowindow;

    function initMap() {
        var california = {lat: 28.7041, lng: 77.1025};
        map = new google.maps.Map(document.getElementById('map'), {
            center: california,
            zoom: 13
        });
        function placeMarker(location) {
            if ( marker ) {
                marker.setPosition(location);
                document.getElementById("p1").innerHTML = "Location data not yet saved.";
            } else {

                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
        }
        google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng);
        });
    }
    function saveData() {
        var latlng = marker.getPosition();
        var elat = document.getElementById('elat');
        elat.value = latlng.lat();
        var elong = document.getElementById('elong');
        elong.value = latlng.lng();
        document.getElementById("p1").innerHTML = "Location Saved";
    }
    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                request.onreadystatechange = doNothing;
                callback(request.responseText, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }

    function doNothing () {
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=Yourgooglemapsapikey&callback=initMap">
</script>
</body>
</html>
