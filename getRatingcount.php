<?php
$servername = "localhost";
$username = "root";
$password = "raheez";
$dbname = "assignment";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$movietitle = $_GET['parameter'];

$sql = "SELECT * FROM userreview WHERE movietitle = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $movietitle);
$stmt->execute();
$result = $stmt->get_result();
$countvalue=0;
if ($result->num_rows > 0) {
    for ($i = 0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_assoc();

        $countvalue = $countvalue + $row["count"] ;

    }

    echo $countvalue/$result->num_rows;
} else {
    echo "0";
}

$stmt->close();
$conn->close();
?>
