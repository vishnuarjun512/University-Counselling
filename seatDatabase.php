<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Two arrays to insert into database
    $RR = array("CS" => 200, "EC" => 200, "EE" => 100, "BT" => 50);
    $EC = array("CS" => 150, "EC" => 150, "EE" => 50);


    // SQL query to create table
    $sql = "CREATE TABLE seats (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  CS INT(3) NOT NULL,
  EC INT(3) NOT NULL,
  EE INT(3) NOT NULL,
  BT INT(3),
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "Table of Seat Matrix created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    // SQL query to insert data into database
    $sql1 = "INSERT INTO seats (CS, EC, EE, BT) VALUES ('" . $RR['CS'] . "', '" . $RR['EC'] . "', '" . $RR['EE'] . "', '" . $RR['BT'] . "')";
    $sql2 = "INSERT INTO seats (CS, EC, EE) VALUES ('" . $EC['CS'] . "', '" . $EC['EC'] . "', '" . $EC['EE'] . "')";
    // Execute queries
    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // Display data from database
    $sql = "SELECT * FROM seats";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<br> CS: " . $row["CS"] . " - EC: " . $row["EC"] . " - EE: " . $row["EE"] . " - BT: " . $row["BT"];
        }
    } else {
        echo "0 results";
    }

    $sql = "UPDATE seats ";
    // Close connection
    $conn->close();
    ?>

</body>

</html>