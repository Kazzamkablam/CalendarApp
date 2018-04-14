<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap core CSS <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mystyles.css" rel="stylesheet">
	<script src="js/myscripts.js"></script>
  </head>

  <body>

<?php
session_start(); //session start, check that session is not empty, if it is return to index.html
include 'session.php'; //get session variables

//echo $dbname;
function addButton($x) { //ugly fix but I'm too tired to figure other solution to this mess, so blame me. Adds button using php for displaying button with javascript function also points!...yay
  $myVal = 'edit'.$x;
  echo '<button type="button"';
  echo ' class="btn btn-primary"'; 
  echo ' onclick="';
  echo 'toggleElement(';
  echo "'$myVal'";
  echo ")";
  echo '">Edit';
  echo "</button>";
  echo '<div id="'.$myVal.'" style= "display:none">';
} 

if ($_SESSION["tunnus"] == "" || $_SESSION["salasana"] == "") { //no session info, redirect to index.php
    header('Location: /index.php');
}
?>

<div class="sidenav"> <!-- side navigation-->
  <a href="#Sivu1">Your Calendar</a>
  <a href="#Sivu2">About</a>

</div>

<div id="Sivu1" class="main">

  <p>Welcome <?php echo ucwords($_SESSION["etunimi"]); ?>. Your current entries:</p>

  <form action="logout.php" method="post"><input type="hidden" name="reset" value="1"><input type="submit" value="Log Out" ></form><!--log out button ala PHP -->


	<?php


include 'fetch.php';  //fetch displayed data with this

sort($tilaisuudet); //sort displayed data

$arrlength = count($tilaisuudet);

echo "<table class='table'>
    <thead>
      <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Description</th>
        <th>Modify</th>
      </tr>
    </thead>";

for ($x = 0; $x < $arrlength; $x++) { //draw user data in viewable form.
  if ( date('Y-m-d') > $tilaisuudet[$x][1]->format('Y-m-d')) {$mycol = 'red'; //expired entries in red, future ones in black
  } else
  {
    $mycol = 'black';
  }
    $y = $x + 1;
    echo "<tr>";  
    echo "<td><font color='$mycol'>(" . $y . ") " . $tilaisuudet[$x][1]->format('Y-m-d') . "</td>";
    echo "<td><font color='$mycol'>" . $tilaisuudet[$x][2]->format('H:i') . "</td>";
    echo "<td><font color='$mycol'>" . $tilaisuudet[$x][3]. "</td>";
    echo "<td>";
    addButton($x);
 

   // echo 'toggleElement("'.$myVal.'")';
    //echo 'div id="'.$myVal.'"';
    
    echo '<form action="delete.php" method="post"><input type="hidden" name="delete" value="' . $tilaisuudet[$x][0] . '"><input type="submit" value="Delete" ></form>'; //add delete button
    echo '<form action="update.php" method="post"><input type="hidden" name="update" value="' . $tilaisuudet[$x][0] . '">Date: <input type="date" name="date" value="' . $tilaisuudet[$x][1]->format('Y-m-d') . '"><BR>Time: <input type="time" name="time" value="' . $tilaisuudet[$x][2]->format('H:i') . '"><BR>Desc: <input type="text" name="desc" value="' . $tilaisuudet[$x][3] . '"><input type="submit" value="Update" ></form>'; //add delete button
    echo '</div>';
    echo "</td></tr>";

}
echo "</table>";
echo "<font color='black'>"; //make sure font color is black
//print_r(date_parse_from_format('Y-m-d','2016-03-01'));
?>
  <hr>
<button type="button" class="btn btn-primary" onclick="toggleElement('new_entry');">Add new entry</button> <!--make fancy form for adding new entries -->

<div id="new_entry" style="display:none;">
<form class="data" action="newentry.php" method="post">
 <div class="form-group">
  <label for="dte">Date:</label>
  <input type="date" class="form-control" id="date" name="date">
</div>
 <div class="form-group">
  <label for="tme">Time:</label>
  <input type="time" class="form-control" id="time" name="time">
</div>
<div class="form-group">
  <label for="pwd">Description:</label>
  <input type="text" class="form-control" id="desc" name="desc">
</div>
<input type="submit" value="Submit">
</form>

</div>

  <hr>
</div>
<div id="Sivu2" class="main">

  <p>noteMeUp (c) Juha Penttinen</p>
  <hr>
</div>

</div>
  </body>
</html>

