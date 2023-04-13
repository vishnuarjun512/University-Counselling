<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    hr {
        background-color: darkblue;
        height: 20px;
    }

    .container {
        margin: 50px auto;
        padding: 20px;
        width: 1000px;
        background-color: #f2f2f2;
        border-radius: 10px;

    }
</style>

<body>
    <p><img src="img/PESU-new-logo (1).png" alt=""></p>
    <hr class="hr">
    <div class="container">
        <h1 style="text-align:center">Document Verification</h1>

    </div>


    <?php
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $pcard = $_POST["pcard"];
    $sslcard = $_POST["sslcard"];
    $pucard = $_POST["pucard"];
    $adharno = $_POST["adharno"];
    $dNo = $_POST["dNo"];
    $damt = $_POST["damt"];

    $conn = new mysqli("localhost", "root", "", "demo");
    if ($conn->connect_error) {
        echo "Connection failed";
    } else {
        echo "Connection successfull";
    }

    $sql = "UPDATE users SET DD_number=$dNo, DD_amount=$damt WHERE username='$fname';";
    mysqli_query($conn, $sql);

    echo "<p>First Name is " . $fname . "</p>";
    echo "<p>Last Name is " . $lname . "</p>";
    echo "<p>PESSAT Rank card " . $pcard . "</p>";
    echo "<p>Your SSLC marks card " . $sslcard . "</p>";
    echo "<p>Your PUC marks card " . $pucard . "</p>";
    echo "<p>Your Aadhar card NUmber is " . $adharno . "</p>";
    echo "<p>Your DD number :" . $dNo . "</p>";
    echo "<p>Your DD Amount :" . $damt . "</p>";
    echo "<a href='welcomkit.html'> Click for Goodies </a>";

    ?>
</body>

</html>