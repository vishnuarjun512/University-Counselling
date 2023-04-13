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
    $RR = array("AI" => 200, "CS" => 200, "ES" => 100, "EE" => 50, "BT" => 50);
    $EC = array("AI" => 150, "CS" => 150, "ES" => 100);


    // SQL query to create table
    $sql = "CREATE TABLE myTable (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  AI INT(3) NOT NULL,
  CS INT(3) NOT NULL,
  ES INT(3) NOT NULL,
  EE INT(3),
  BT INT(3),
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "Table myTable created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // SQL query to insert data into database
    $sql1 = "INSERT INTO myTable (AI, CS, ES, EE, BT) VALUES ('" . $RR['AI'] . "', '" . $RR['CS'] . "', '" . $RR['ES'] . "', '" . $RR['EE'] . "', '" . $RR['BT'] . "')";
    $sql2 = "INSERT INTO myTable (AI, CS, ES) VALUES ('" . $EC['AI'] . "', '" . $EC['CS'] . "', '" . $EC['ES'] . "')";

    // Execute queries
    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Display data from database
    $sql = "SELECT * FROM myTable";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<br> AI: " . $row["AI"] . " - CS: " . $row["CS"] . " - ES: " . $row["ES"] . " - EE: " . $row["EE"] . " - BT: " . $row["BT"];
        }
    } else {
        echo "0 results";
    }

    $sql = "UPDATE myTable ";
    // Close connection
    $conn->close();
    ?>

</body>

</html>