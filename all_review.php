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

if ($result->num_rows > 0) {
    for ($i = 0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_assoc();
        echo '<div class="review">';
        echo '<div class="review_rating">';
        echo '<img class="star" src="liked.png"/>';
        echo $row["count"] ;
        echo '/10 </div>';
        echo "<h3>";
        echo $row["title"]; 
        echo "</h3>";
        echo '<span class="username">';
        echo $row["email"];
        echo ' ';
        echo $row["date"];
        echo '</span>';
        echo '<p>';
        echo $row["description"];
        echo '</p>';
        echo '</div>';

    }
} else {
    echo "No results found.";
}

$stmt->close();
$conn->close();
?>
