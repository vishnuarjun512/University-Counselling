<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
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

        h1 {
            font-size: 36px;
            margin-bottom: 30px;
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
    </style>
</head>

<body>
    <p><img src="img/PESU-new-logo (1).png"></p>
    <hr class="hr">
    <h1 class="my-5">Hi, <b>Welcome to PES University.</b></h1>
    <div class="container">
        <h1>Seat Selection Process</h1>
        <form method="POST" action="reg.php">

            <label for="rank">Rank:</label>
            <input type="number" name="rank" id="rank" oninput="updateSlotOptions()" style="text-align: center;" required>
            <br>

            <label for="slot">Slot:</label>
            <select name="slot" id="slot" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            <br>

            <!-- <label for="rank">Enter your rank:</label> -->
            <!-- <input type="number" id="rank" name="rank" style="text-align: center;" required> -->
            <br>
            <label for="campus">Select your preferred campus:</label>
            <select id="campus" name="campus" onchange="updateBranchOptions()" height="40" required>
                <option value="" style="text-align: center;">--Select Campus--</option>
                <option value="RR">Ring Road Campus</option>
                <option value="EC">Electronic City Campus</option>
            </select>
            <br>
            <label for="branch">Select your preferred branch:</label>
            <select id="branch" name="branch" height="40" required>
                <option value="" style="text-align: center;">--Select Branch--</option>
                <option value="CS">Computer Science</option>
                <option value="EC">Electronics and Communication</option>
                <option value="EE" disabled title="Seat not available">Electrical and Electronics</option>
                <option value="BT" disabled title="Seat not available">Biotechnology</option>
            </select>
            <br>
            <input type="submit" value="Submit">
        </form>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>

    <script>
        function updateBranchOptions() {
            var campusSelect = document.getElementById("campus");
            var branchSelect = document.getElementById("branch");
            var campus = campusSelect.value;

            // Check if the campus is Electronic City Campus
            if (campus === "EC") {
                // Loop through the options in the branch select element
                for (var i = 0; i < branchSelect.options.length; i++) {
                    var option = branchSelect.options[i];
                    var value = option.value;
                    // Disable the Electrical and Electronics and Biotechnology options
                    if (value === "EE" || value === "BT") {
                        option.disabled = true;
                        option.title = "Seat not available";
                    } else {
                        option.disabled = false;
                        option.title = "";

                    }
                }
            } else {
                // Enable all options in the branch select element
                for (var i = 0; i < branchSelect.options.length; i++) {
                    var option = branchSelect.options[i];
                    option.disabled = false;
                    option.title = "";
                }
            }
        }

        function updateSlotOptions() {
            var rankInput = document.getElementById("rank");
            var slotSelect = document.getElementById("slot");
            var rank = parseInt(rankInput.value);

            slotSelect.options.length = 0; // remove all options
            if (rank < 2000) {
                slotSelect.options[0] = new Option("1", "1");
                slotSelect.options[1] = new Option("2", "2");
                slotSelect.options[2] = new Option("3", "3");
            } else if (rank > 2000 && rank < 4000) {
                slotSelect.options[0] = new Option("2", "2");
                slotSelect.options[1] = new Option("3", "3");
            } else {
                slotSelect.options[0] = new Option("3", "3");
            }
        }
    </script>
</body>

</html>