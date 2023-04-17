<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

    .details{
        background-color: #f2f2f2;
        
        color: black;
        font-family: sans-serif;
   border-radius: 4px;
   width: 400px;
   margin-left: 550px;
   
    }
span{
    font-weight: bolder;
}

.goodies{
    text-align: center;
    margin-left: 550px;
    /* color: #f2f2f2; */

}

.clickingGoodies{
    text-align: center;
    color: #f2f2f2;
}
</style>

<body>
    <p><img src="img/PESU-new-logo (1).png" alt=""></p>
    <hr class="hr">
    <div class="container">
        <h1 style="text-align:center; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;font-style: normal;"><u>Document Verification</u></h1>

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
    // if ($conn->connect_error) {
    //     echo "Connection failed!";
    // } else {
    //     echo "Connection successfull!";
    // }

    $sql = "UPDATE users SET DD_number=$dNo, DD_amount=$damt WHERE username='$fname';";
    mysqli_query($conn, $sql);
    echo"<div class='details'>";
echo"<br>";
    echo "<p><span>&nbsp; First Name: </span>" . $fname . "</p>";
    echo "<p><span>&nbsp; Last Name: </span>" . $lname . "</p>";
    echo "<p><span>&nbsp; PESSAT Rank card </span>: " . $pcard . "</p>";
    echo "<p><span>&nbsp; Your SSLC marks card </span>: " . $sslcard . "</p>";
    echo "<p><span>&nbsp; Your PUC marks card:  </span>" . $pucard . "</p>";
    echo "<p><span>&nbsp; Your Aadhar card Number:  </span>" . $adharno . "</p>";
    echo "<p><span>&nbsp; Your DD number : </span>" . $dNo . "</p>";
    echo "<p><span>&nbsp; Your DD Amount : </span>" . $damt . "</p>";
    echo"<br>";

    echo"</div>";

    echo "<button class='btn btn-dark goodies'>";
    echo " <a class='clickingGoodies' href='welcomkit.html'> Click for Goodies </a>";

    echo "</button>";
    echo "<br>";
    echo "<br>";

    ?>
</body>

</html>