<?php

$servername = "localhost"; 
$username = "root"; 
$password = "raheez"; 
$dbname = "assignment"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!])(?=.*[a-zA-Z\d@#$%^&+=!]).{8,}$/";
$stmt = $conn->prepare("INSERT INTO user (email,username, password) VALUES (?,?, ?)");

if(strlen($username)===0){
    echo "username cannot be empty";
}
else if(strlen($password)===0){
    echo "password cannot be empty";
}
else if(preg_match($pattern, $password)) {
    $stmt->bind_param("sss",$email, $username, $password);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "Signup successful!";
    } else {
        echo "Signup failed!";
    }
} else {
    echo "Password is not valid.";
}

$stmt->close();
$conn->close();
?>
