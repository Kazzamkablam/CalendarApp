 <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap core CSS <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mystyles.css" rel="stylesheet">

  </head>

  <body>

 <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "localdb";
$loguser = $_POST["usr"]; //get some basic data
$logpwd = $_POST["pwd"];
$logfname = $_POST["fname"];
$loglname = $_POST["lname"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) { //connection error, give some info...
    die("Connection failed: " . $conn->connect_error);
}

$logfname = filter_var($logfname, FILTER_SANITIZE_STRING); //sanitize inputs
$loglname = filter_var($loglname, FILTER_SANITIZE_STRING);
$loguser = filter_var($loguser, FILTER_SANITIZE_STRING);
$logpwd = filter_var($logpwd, FILTER_SANITIZE_STRING);

$logpwd = md5($logpwd); //encrypt password

$sql = "INSERT INTO kayttaja (kayttaja_id, etunimi, sukunimi, tunnus, salasana)
VALUES (0, '$logfname' , '$loglname', '$loguser', '$logpwd')";

if ($conn->query($sql) === true) { //give some info to user.
    echo "Account created successfully, you may now log in.";
    echo "<br><br><a href='index.php' class='btn btn-primary btn-sm'>Back</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error; //error happened
    echo "<br><br><a href='register.html' class='btn btn-primary btn-sm'>Back</a>";
}

$conn->close();
?>

  </body>
</html>