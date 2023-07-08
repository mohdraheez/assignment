<?php
$servername = "localhost";
$username = "root";
$password = "raheez";
$dbname = "assignment";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_COOKIE['username'];
$title = $_POST['title'];
$movietitle = $_POST['movietitle'];
$description = $_POST['description'];
$count = $_POST['count2'];
$titlelen = strlen($title);
$descriptionlen = strlen($description);
$today = date("Y-m-d");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($titlelen===0) {
        echo "Review Failed!! Title is Empty";
    } 
    else if($count==='0'){
        echo "Review Failed!! Rating is set to null";
    }
    else if($descriptionlen===0){
        echo "Review Failed!! Description is Empty";
    }
    else {
        $stmt = $conn->prepare("INSERT INTO userreview (email, title, description, count, movietitle,date) VALUES (?, ?, ?, ?, ?,?)");
        $sql = "DELETE FROM userreview WHERE email = ? and movietitle = ?";
        $stmt2 = $conn->prepare($sql);
        $stmt2->bind_param("ss", $email,$movietitle);
        $stmt2->execute();
        $stmt->bind_param("ssssss", $email, $title, $description, $count, $movietitle,$today);

        if ($stmt->execute()) {
            echo "Review Successful..";
            echo '<script>';
            echo 'alert("review successful");';
            echo '</script>';
            
        } else {
            echo "Error";
        }

        $stmt->close();
    }
}

$conn->close();
?>
