<?php 
$servername = "localhost"; 
$username = "root"; 
$password = "raheez"; 
$dbname = "assignment"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$usernameFromForm = $_POST['username'];
$password = $_POST['password'];
$FetchedPassword;

$stmt = $conn->prepare("SELECT password FROM user WHERE email = ?");
$stmt->bind_param("s", $usernameFromForm);

if ($stmt->execute()) {
    $stmt->bind_result($FetchedPassword);

    if ($stmt->fetch()) {
        if($FetchedPassword=$password){
            echo "Login Successfull";
            setcookie("username",$usernameFromForm);
            setcookie("password",$password);
            setcookie("isloggedin","true");
            header("Location:/assignment");
        }
        else{
            echo "Incorrect Password";
        }
    } else {
        echo "No user found with the provided Email.";
    }

    $stmt->close();
} else {
    echo "Error executing the query: " . $stmt->error;
}
$conn->close();
?>


