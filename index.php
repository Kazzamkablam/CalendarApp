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
session_start(); //session start, check if session is not empty, if it is not, EXPRESS HIGHWAY TO PROGRAM!
if (isset($_SESSION["tunnus"]) && isset($_SESSION["salasana"])) { //check that session variables are set
    if ($_SESSION["tunnus"] != "" && $_SESSION["salasana"] != "") { //if they are check that they are not empty
        header('Location: /PHPSQL/main.php'); //too the main.php zone!
    }
}
//    echo ($_SESSION["tunnus"]);
?>
<div class="login">
<h4>noteMeUp</h4>
<form action="connect.php" method="post"> <!-- basic log in form -->
 <div class="form-group">
  <label for="usr">Username:</label>
  <input type="text" class="form-control" id="usr" name="usr">
</div>
<div class="form-group">
  <label for="pwd">Password:</label>
  <input type="password" class="form-control" id="pwd" name="pwd">
</div>
  <input type="submit" value="Sign In" class="btn btn-primary"></button>   <a href="register.html" class="btn btn-primary">Register</a>
</form>
  <hr>

</div>
</div>
  </body>
</html>
