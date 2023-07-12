<?php
$email = $_GET['email'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "health_reports";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT health_reports FROM health_reports WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pdfPath = $row['health_reports'];
 
    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($pdfPath) . '"');
    readfile($pdfPath);
} else {
    echo "No health report found for the given email ID.";
}

$conn->close();
?>
