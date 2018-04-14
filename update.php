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
session_start();
include 'session.php'; //get session variables

$logdate = $_POST["date"];
$logtime = $_POST["time"];
$logdesc = $_POST["desc"];
$logupdate = $_POST["update"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE aika SET paiva='$logdate', kellonaika='$logtime', kuvaus='$logdesc' WHERE Aika_ID='$logupdate'"; //update fields

if ($conn->query($sql) === TRUE) { //give some feedback
    echo "Record updated successfully";
    echo "<br><a href='main.php' class='btn btn-primary btn-sm'>Ok</a>";
} else {
    echo "Error updating record: " . $conn->error; //error happened
    echo "<br><a href='main.php' class='btn btn-primary btn-sm'>Ok</a>";
}

$conn->close();
?> 

 </body>
</html>