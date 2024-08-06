<?php
include('./includes/db.php');

if (isset($_GET['id']) && isset($_GET['job_id'])) {
    $app_id = $_GET['id'];
    $job_id = $_GET['job_id'];

    // Delete the application from the database
    $sql = "DELETE FROM applications WHERE id = $app_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the view applications page after deletion
        header("Location: view_applications.php?id=" . $job_id);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
