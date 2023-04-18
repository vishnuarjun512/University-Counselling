<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }

    table th,
    table td {
        padding: 8px;
        text-align: left;
        vertical-align: middle;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #f2f2f2;
    }

    table td button {
        background-color: #f44336;
        color: white;
        border: none;
        cursor: pointer;
    }

    table td button:hover {
        background-color: #d32f2f;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 8px 16px;
        border: none;
        cursor: pointer;
        margin-top: 20px;
    }

    button:hover {
        background-color: #3e8e41;
    }
</style>


<body>
    <?php
    // connect to the database
    $connection = mysqli_connect("localhost", "root", "", "demo");

    // retrieve data from three tables
    $query1 = "SELECT * FROM Slot1";
    $query2 = "SELECT * FROM Slot2";
    $query3 = "SELECT * FROM Slot3";
    $result1 = mysqli_query($connection, $query1);
    $result2 = mysqli_query($connection, $query2);
    $result3 = mysqli_query($connection, $query3);

    // display data in HTML tables
    echo "<h2>Table 1</h2>";
    echo "<table>";
    while ($row = mysqli_fetch_assoc($result1)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['studentname'] . "</td>";
        echo "<td>" . $row['branch'] . "</td>";
        echo "<td>" . $row['campus'] . "</td>";
        echo "<td>" . $row['DD_number'] . "</td>";
        echo "<td>" . $row['DD_amount'] . "</td>";
        echo "<td>" . $row['Token'] . "</td>";
        echo "<td><button onclick=\"deleteRow('Slot1', " . $row['id'] . ")\">Delete</button></td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<h2>Table 2</h2>";
    echo "<table>";
    while ($row = mysqli_fetch_assoc($result2)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['studentname'] . "</td>";
        echo "<td>" . $row['branch'] . "</td>";
        echo "<td>" . $row['campus'] . "</td>";
        echo "<td>" . $row['DD_number'] . "</td>";
        echo "<td>" . $row['DD_amount'] . "</td>";
        echo "<td>" . $row['Token'] . "</td>";
        echo "<td><button onclick=\"deleteRow('Slot2', " . $row['id'] . ")\">Delete</button></td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<h2>Table 3</h2>";
    echo "<table>";
    while ($row = mysqli_fetch_assoc($result3)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['studentname'] . "</td>";
        echo "<td>" . $row['branch'] . "</td>";
        echo "<td>" . $row['campus'] . "</td>";
        echo "<td>" . $row['DD_number'] . "</td>";
        echo "<td>" . $row['DD_amount'] . "</td>";
        echo "<td>" . $row['Token'] . "</td>";
        echo "<td><button onclick=\"deleteRow('Slot3', " . $row['id'] . ")\">Delete</button></td>";
        echo "</tr>";
    }
    echo "</table>";

    // delete row from table when button is clicked
    if (isset($_POST['table']) && isset($_POST['id'])) {
        $table = $_POST['table'];
        $id = $_POST['id'];
        $delete_query = "DELETE FROM $table WHERE id = $id";
        mysqli_query($connection, $delete_query);
    }

    mysqli_close($connection);

    echo "<a href='login.php'><button>Go Back to Login Page</button> </a>";
    ?>

    <script>
        // send AJAX request to delete row from table
        function deleteRow(table, id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    location.reload(); // refresh page to see updated table(s)
                }
            };
            xhttp.open("POST", "", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("table=" + table + "&id=" + id);
        }
    </script>
</body>

</html>