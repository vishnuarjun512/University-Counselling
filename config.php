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
    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'demo');


    // Connection 
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
    if ($link === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $query = "CREATE DATABASE IF NOT EXISTS " . DB_NAME . ";";
    if (mysqli_query($link, $query)) {
        echo "<br>Database Operation Done Successfully";
    } else {
        echo "<br>Database Operation Failed";
    }

    mysqli_select_db($link, DB_NAME);

    $query = "CREATE TABLE IF NOT EXISTS `users` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(50) NOT NULL,
        `password` varchar(255) NOT NULL,
        `gmail` varchar(50) NOT NULL,
        `rank` int,
        `puc_marks` int,
        `DD_number` int,
        `DD_amount` int,
        `Course` varchar(10),
        `Branch` varchar(4),
        `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
        `bookedSeat` int,
        `confirmSeat` int,
        PRIMARY KEY (`id`),
        UNIQUE KEY `username` (`username`)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

    if (mysqli_query($link, $query)) {
        echo "<br>Database Operation Done Successfully";
    } else {
        echo "<br>Database Operation Failed";
    }


    /* Attempt to connect to MySQL database */
    // Check connection

    ?>
</body>

</html>