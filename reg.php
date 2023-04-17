<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		body {
			font: 14px sans-serif;
			text-align: center;
		}

		.container {
			margin: 50px auto;
			padding: 20px;
			width: 500px;
			background-color: #f2f2f2;
			border-radius: 10px;
			text-align: center;
		}

		.hr {
			background-color: darkblue;
			height: 20px;
		}

		h3 {
			/* font-family: ; */
			font-weight: bold;

			margin-bottom: 30px;
		}

		h2 {
			font-weight: bold;
			font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
		}

		label {
			font-size: 24px;
			display: block;
			margin-bottom: 10px;
		}

		select {
			font-size: 18px;
			padding: 5px;
			margin-bottom: 20px;
			height: 37px;
			width: 100%;

		}

		option {
			text-align: center;
		}

		input[type="number"] {
			font-size: 18px;
			padding: 5px;
			margin-bottom: 20px;
			width: 100%;
			box-sizing: border-box;
		}

		input[type="submit"] {
			font-size: 24px;
			padding: 10px 20px;
			background-color: #2f1785;
			color: #fff;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #3b14c8;
		}

		.seatSelection {
			/* font-family: 'Courier New', Courier, monospace; */
			text-align: left;
			font-weight: 550;
			background-color: #333;
			color: #fff;
			width: fit-content;
			border-radius: 5px;
			margin-left: 530px;
		}
	</style>
</head>
<p><img src="img/PESU-new-logo (1).png"></p>
<hr class="hr">

<body>
	<?php
	session_start();

	// Redirect to the login page if the user is not logged in
	if (!isset($_SESSION['username'])) {
		header("Location: login.php");
		exit();
	} else {
		echo "<script>alert('Username not set \n Check Header Function')</script>";
	}
	// Define the seat matrix
	// require_once "config.php";
	$seatMatrix = array(
		"RR" => array(
			"CS" => 200,
			"EC" => 200,
			"EE" => 50,
			"BT" => 50
		),
		"EC" => array(
			"EC" => 400,
			"CS" => 150,
			"EE" => 150,
			"BT" => 100
		)
	);

	// Get the form data
	$slot = $_POST["slot"];
	$rank = $_POST["rank"];
	$time = "";
	if ($rank > 0 && $rank < 2000) {
		$time = "8:30 - 11:30";
	} else if ($rank > 2000 && $rank < 4000) {
		$time = "11:30 - 2:30";
	} else if ($rank > 4000 && $rank < 6000) {
		$time = "2:30 - 5:30";
	}




	$link = new mysqli("localhost", "root", "", "demo");
	// Display data from database
	$sql = "SELECT * FROM seats";
	$result = $link->query($sql);
	echo "<h3 class = 'seatMatrix'> Seat Matrix Before :</h3>";
	$i = 1;
	if ($result->num_rows > 0) {
		// Output data of each row
		while ($row = $result->fetch_assoc()) {
			if ($i == 1) {
				echo "RR Campus -> ";
			} else {
				echo "EC Campus -> ";
			}
			echo "CS: " . $row["CS"] . " - EC: " . $row["EC"] . " - EE: " . $row["EE"] . " - BT: " . $row["BT"] . "<br>";
			$i++;
		}
	} else {
		echo "0 results<br>";
	}
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";

	$column_name = $_POST['branch'];
	$idref = "";
	$campus = $_POST["campus"];




	if ($campus == "RR") {
		$idref = 1;
	} else {
		$idref = 2;
	}
	$branch = $_POST["branch"];

	// mysqli_query($link, $sql);

	$sql = "UPDATE seats SET $column_name = $column_name-1 WHERE id=$idref";
	mysqli_query($link, $sql);



	// Display data from database
	$sql = "SELECT * FROM seats";
	$result = $link->query($sql);

	echo "<h3 class = 'seatMatrix'> Seat Matrix After: </h3>";
	$i = 1;
	if ($result->num_rows > 0) {
		// Output data of each row
		while ($row = $result->fetch_assoc()) {
			if ($i == 1) {
				echo "RR Campus -> ";
			} else {
				echo "EC Campus -> ";
			}
			echo "CS: " . $row["CS"] . " - EC: " . $row["EC"] . " - EE: " . $row["EE"] . " - BT: " . $row["BT"] . "<br>";
			$i += 1;
		}
		echo "<br>";
	} else {
		echo "0 results";
	}
	echo "<hr style='height:5px;background-color:black'>";
	// Check if the selected campus and branch have available seats
	if ($seatMatrix[$campus][$branch] > 0) {
		// Display the seat selection confirmation
		$seatMatrix[$campus][$branch]--;
		echo "<h2>Congratulations! You have been selected for seat selection.</h2>";

		echo "<div class='seatSelection'";
		echo "<br>";
		echo "<br>";

		echo "<p>Your slot is:  " . $slot . "</p>";
		echo "<p>Your Alloted Time is:  " . $time . "</p>";
		echo "<p>Your rank is:  " . $rank . "</p>";
		echo "<p>Your preferred campus: " . $campus . " </p>";
		echo "<p>Your preferred branch: " . $branch . "</p>";
		echo "<p>Please proceed to the seat selection process to complete your admission.</p>";
		echo "<a href ='doc.html'>Next process</a>";
		echo "<br>";
		echo "<br>";
		echo "</div>";
	} else {
		// Display the seat selection rejection
		echo "<h2>We're sorry, but the selected campus and branch do not have available seats.</h2>";
		echo "<p>Please try selecting a different campus or branch.</p>";
		echo "<a href ='welcome.php'>Try for another Seat</a>";
	}
	$conn = new mysqli("localhost", "root", "", "demo");
	$user = $_SESSION['username'];
	$sql = "UPDATE users SET rank=$rank, course='$branch', branch='$campus' WHERE username='$user' ;";
	$conn->query($sql);
	?>
</body>

</html>