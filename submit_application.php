<?php
include('./includes/db.php');

// Ensure form was submitted with a file
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['resume']) && isset($_POST['job_id']) && isset($_POST['name']) && isset($_POST['email'])) {
    $job_id = $_POST['job_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // File upload handling
    $resume = $_FILES['resume'];
    $resume_name = $resume['name'];
    $resume_tmp_name = $resume['tmp_name'];
    $resume_error = $resume['error'];
    $resume_size = $resume['size'];
    $resume_ext = pathinfo($resume_name, PATHINFO_EXTENSION);

    // Define allowed file types and max file size
    $allowed_exts = ['pdf', 'doc', 'docx'];
    $max_size = 5 * 1024 * 1024; // 5MB

    if ($resume_error === UPLOAD_ERR_OK) {
        if (in_array($resume_ext, $allowed_exts) && $resume_size <= $max_size) {
            $resume_new_name = uniqid('', true) . "." . $resume_ext;
            $resume_destination = 'uploads/' . $resume_new_name;

            if (move_uploaded_file($resume_tmp_name, $resume_destination)) {
                // Save file path to the database
                $sql = "INSERT INTO applications (job_id, name, email, resume, application_date)
                        VALUES ('$job_id', '$name', '$email', '$resume_destination', CURDATE())";

                if ($conn->query($sql) === TRUE) {
                    $message = "Application submitted successfully";
                } else {
                    $message = "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                $message = "Failed to move uploaded file.";
            }
        } else {
            $message = "Invalid file type or size too large.";
        }
    } else {
        $message = "Error uploading file.";
    }
} else {
    $message = "Missing form data.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <title>Application Status</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5"><?php echo $message; ?></h1>
        <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>
</html>
