<?php
$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$email = $_POST['email'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "health_reports";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO health_reports (name, age, weight, email) VALUES ('$name', '$age', '$weight', '$email')";
if ($conn->query($sql) === TRUE) {
    $userId = $conn->insert_id;

    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES['report']['name']);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if ($fileType != "pdf") {
        echo "Only PDF files are allowed.";
        $uploadOk = 0;
    }

   
    if (file_exists($targetFile)) {
        echo "File already exists.";
        $uploadOk = 0;
    }

    if ($uploadOk) {
        if (move_uploaded_file($_FILES['report']['tmp_name'], $targetFile)) {
  
            $pdfPath = $targetDir . $_FILES['report']['name'];

            $sql = "UPDATE health_reports SET health_report = '$pdfPath' WHERE name = $name";
            $conn->query($sql);

            echo "Form submitted successfully!";
        } else {
            echo "Error uploading file.";
        }
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
