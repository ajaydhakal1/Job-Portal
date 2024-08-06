<?php
include('./includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['company']) && isset($_POST['location'])) {
    $job_id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $company = $_POST['company'];
    $location = $_POST['location'];

    $sql = "UPDATE jobs SET title='$title', description='$description', company='$company', location='$location' WHERE id=$job_id";

    if ($conn->query($sql) === TRUE) {
        echo "Job details updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
<a href="index.php" class="btn btn-secondary mt-3">Back to Home</a>
