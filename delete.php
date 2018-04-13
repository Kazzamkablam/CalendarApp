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
$logdelete = $_POST["delete"];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "DELETE FROM aikataulu WHERE Aika_ID='$logdelete'";

if ($conn->query($sql) === true) {
    $sql = "DELETE FROM aika WHERE Aika_ID='$logdelete'";

    if ($conn->query($sql) === true) {
        echo "Record deleted successfully";
        echo "<br><a href='main.php' class='btn btn-primary btn-sm'>Ok</a>";
    } else {
        echo "Error deleting record: " . $conn->error;
        echo "<br><a href='main.php' class='btn btn-primary btn-sm'>Ok</a>";
    }
} else {
    echo "Error deleting record: " . $conn->error;
    echo "<br><a href='main.php' class='btn btn-primary btn-sm'>Ok</a>";
}
$conn->close();
?>

  </body>
</html>