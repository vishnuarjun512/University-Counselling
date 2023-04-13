<?php
session_start();

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
	exit();
} else {
	echo "Username not set <br> Check header function";
}
// Define the seat matrix
// require_once "config.php";
$seatMatrix = array(
	"RR" => array(
		"CS" => 200,
		"EC" => 200,
		"EE" => 50,
		"BT" => 50,
		"RR" => 600
	),
	"EC" => array(
		"EC" => 400,
		"CS" => 150,
		"EE" => 150,
		"BT" => 100
	)
);

// Get the form data
$slot = "";
$time = "";
$rank = $_POST["rank"];
if ($rank > 0 && $rank < 2000) {
	$slot = 1;
	$time = "8:30 - 11:30";
} else if ($rank > 2000 && $rank < 4000) {
	$slot = 2;
	$time = "11:30 - 2:30";
} else if ($rank > 4000 && $rank < 6000) {
	$slot = 3;
	$time = "2:30 - 5:30";
}
$idref = "";
$campus = $_POST["campus"];
if ($campus == "RR") {
	$idref = 1;
} else {
	$idref = 2;
}
$branch = $_POST["branch"];


$link = new mysqli("localhost", "root", "", "demo");
// Display data from database
$sql = "SELECT * FROM myTable";
$result = $link->query($sql);
echo "Seat Matrix Before : <br>";
if ($result->num_rows > 0) {
	// Output data of each row
	$i = 1;
	while ($row = $result->fetch_assoc()) {
		echo "<br>Campus -> AI: " . $row["AI"] . " - CS: " . $row["CS"] . " - ES: " . $row["ES"] . " - EE: " . $row["EE"] . " - BT: " . $row["BT"];
	}
} else {
	echo "0 results<br>";
}
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

$column_name = $_POST['branch'];
// $idref = 5;
// $column_name = "AI";
// $sql = "USE seatMatrix";
mysqli_query($link, $sql);

$sql = "UPDATE myTable SET $column_name = $column_name-1 WHERE id=$idref";
mysqli_query($link, $sql);



// Display data from database
$sql = "SELECT * FROM myTable";
$result = $link->query($sql);

echo "Seat Matrix After : <br>";
if ($result->num_rows > 0) {
	// Output data of each row
	while ($row = $result->fetch_assoc()) {
		echo "<br> AI: " . $row["AI"] . " - CS: " . $row["CS"] . " - ES: " . $row["ES"] . " - EE: " . $row["EE"] . " - BT: " . $row["BT"];
	}
	echo "<br>";
} else {
	echo "0 results";
}

// Check if the selected campus and branch have available seats
if ($seatMatrix[$campus][$branch] > 0) {
	// Display the seat selection confirmation
	$seatMatrix[$campus][$branch]--;
	echo "<h2>Congratulations! You have been selected for seat selection.</h2>";
	echo "<p>Your slot is:  " . $slot . "</p>";
	echo "<p>Your Alloted Time is:  " . $time . "</p>";
	echo "<p>Your rank is:  " . $rank . "</p>";
	echo "<p>Your preferred campus: " . $campus . " </p>";
	echo "<p>Your preferred branch: " . $branch . "</p>";
	echo "<p>Please proceed to the seat selection process to complete your admission.</p>";
	echo "<a href ='doc.html'>Next process</a>";
	echo "<br>";
} else {
	// Display the seat selection rejection
	echo "<h2>We're sorry, but the selected campus and branch do not have available seats.</h2>";
	echo "<p>Please try selecting a different campus or branch.</p>";
}

$conn = new mysqli("localhost", "root", "", "demo");
$user = $_SESSION['username'];
$sql = "UPDATE users SET rank=$rank, course='$branch', branch='$campus' WHERE username='$user' ;";
$conn->query($sql);
