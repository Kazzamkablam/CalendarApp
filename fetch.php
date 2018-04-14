 <?php

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$sql = "SELECT id, firstname, lastname FROM MyGuests";

$sql = "
SELECT aika.Aika_ID, aikataulu.Kayttaja_ID, aika.paiva, aika.kellonaika, aika.kuvaus
FROM aika
INNER JOIN aikataulu ON aika.Aika_ID=aikataulu.Aika_ID;
";

//$sql = "SELECT Aika_ID, paiva, kellonaika, kuvaus FROM aika";
$result = $conn->query($sql);

$tilaisuudet = array();

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) { //fetch our data from database
        $paiva = date_create($row["paiva"]);
        $kello = date_create($row["kellonaika"]);
        $kuvaus = $row["kuvaus"];
		$id = $row["Kayttaja_ID"];
		$aikaID = $row["Aika_ID"];

        if ($id == $_SESSION["ID"]) { // identified user, only display OWN data.
            $newdata = array($aikaID, $paiva, $kello, $kuvaus);
            array_push($tilaisuudet, $newdata);
        }
    }

} else {
    echo "0 results";
}
$conn->close();
?>

