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
ini_set('display_errors', 1);
error_reporting(E_ALL);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "localdb";
include 'get-connection.php'; //get database info from database, comment if you are using locally instead of azure.

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



$stmt = $conn->prepare("INSERT INTO kayttaja (etunimi, sukunimi, tunnus, salasana) VALUES (?, ?, ?, ?)"); //prepared statement, mostly for the 4 points
$stmt->bind_param("ssss", $logfname, $loglname, $loguser, $logpwd); 

if (!$stmt->execute()) {

    if ($stmt->errno == 1062) { // execute throwed duplicate entry error, display some text
        echo "Username already exists";
        echo "<br><br><a href='register.html' class='btn btn-primary btn-sm'>Back</a>";
    } else { //something else happened, display built in error messages
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        echo "<br><br><a href='register.html' class='btn btn-primary btn-sm'>Back</a>";
    }
} else { //yay huge success!
    echo "Account created successfully, you may now log in.";
    echo "<br><br><a href='index.php' class='btn btn-primary btn-sm'>Back</a>";
}

$stmt->close();
$conn->close();
?>

  </body>
</html>