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
$mysession = $_SESSION["ID"];

$logdate = filter_var($logdate, FILTER_SANITIZE_STRING); //sanitize inputs
$logtime = filter_var($logtime, FILTER_SANITIZE_STRING);
$logdesc = filter_var($logdesc, FILTER_SANITIZE_STRING);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO aika (Aika_id, paiva, kellonaika, kuvaus)
VALUES ('0', '$logdate', '$logtime', '$logdesc' )";

//insert some data
if ($conn->query($sql) === true) {
    //echo "New record created successfully<br><a href='main.php' class='btn btn-primary btn-sm'>Ok</a>";
    $my_id = mysqli_insert_id($conn);

    $sql = "INSERT INTO aikataulu (aikataulu_id, Kayttaja_id, aika_id)
    VALUES ('0', '$mysession', '$my_id')";
    // $_SESSION["ID"] = $row["Kayttaja_ID"];
    if ($conn->query($sql) === true) { //give user some feedback
        echo "New record created successfully<br><a href='main.php' class='btn btn-primary btn-sm'>Ok</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; //error happened!
        echo "<br><a href='main.php' class='btn btn-primary btn-sm'>Ok</a>";
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    echo "<br><a href='main.php' class='btn btn-primary btn-sm'>Ok</a>";
}

$conn->close();
?>

  </body>
</html>