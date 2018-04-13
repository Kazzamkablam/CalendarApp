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
session_start(); //basic user information
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "localdb";

$loguser = $_POST["usr"];
$logpwd = $_POST["pwd"];

$loguser = filter_var($loguser, FILTER_SANITIZE_STRING); //sanitize inputs
$logpwd = filter_var($logpwd, FILTER_SANITIZE_STRING);
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo $loguser;
$sql = "SELECT Kayttaja_ID, etunimi, tunnus, salasana FROM kayttaja WHERE tunnus='$loguser'"; //use query to find user information
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {

        if ($row["tunnus"] == $loguser && $row["salasana"] == md5($logpwd)) { //compare user inputted information to data in the database, if match enable session with the data provided...
            echo "Login successful";
            $_SESSION["tunnus"] = $loguser;
            $_SESSION["salasana"] = $logpwd;
            $_SESSION["ID"] = $row["Kayttaja_ID"];
            $_SESSION["etunimi"] = $row["etunimi"];
            header('Location: /PHPSQL/main.php'); //redirect to main.php
        } else {
            echo "Login failed invalid username or password<br><br><a href='index.php' class='btn btn-primary btn-sm'>Back</a>"; //add some info and buttons in case of failure.
        }
    }
} else {
    echo "Login failed invalid username or password<br><br><a href='index.php' class='btn btn-primary btn-sm'>Back</a>"; //add some info and buttons in case of failure.
}

$conn->close(); //close connection
?>
  </body>
</html>