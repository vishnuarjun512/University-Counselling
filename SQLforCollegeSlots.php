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

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create database
    $sql = "CREATE DATABASE demo";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    // Close connection to create new connection with demo database
    $conn->close();

    // Create connection with demo database
    $conn = new mysqli($servername, $username, $password, "demo");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create Slot1 table
    $sql = "CREATE TABLE Slot1 (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            studentname VARCHAR(30) NOT NULL,
            rank INT(4) NOT NULL,
            campus VARCHAR(30) NOT NULL,
            branch VARCHAR(30) NOT NULL
        )";

    if ($conn->query($sql) === TRUE) {
        echo "Table Slot1 created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // Create Slot2 table
    $sql = "CREATE TABLE Slot2 (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            studentname VARCHAR(30) NOT NULL,
            rank INT(4) NOT NULL,
            campus VARCHAR(30) NOT NULL,
            branch VARCHAR(30) NOT NULL
        )";

    if ($conn->query($sql) === TRUE) {
        echo "Table Slot2 created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // Create Slot3 table
    $sql = "CREATE TABLE Slot3 (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            studentname VARCHAR(30) NOT NULL,
            rank INT(4) NOT NULL,
            campus VARCHAR(30) NOT NULL,
            branch VARCHAR(30) NOT NULL
        )";

    if ($conn->query($sql) === TRUE) {
        echo "Table Slot3 created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $conn->close();
    ?>
</body>

</html>