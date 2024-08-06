<?php
include('./includes/db.php');

$title = $_POST['title'];
$description = $_POST['description'];
$company = $_POST['company'];
$location = $_POST['location'];
$salary = $_POST['salary'];
$application_deadline = $_POST['application_deadline'];

$sql = "INSERT INTO jobs (title, description, company, location, salary, posted_date, application_deadline)
VALUES ('$title', '$description', '$company', '$location', '$salary', CURDATE(), '$application_deadline')";

if ($conn->query($sql) === TRUE) {
    echo "New job created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
