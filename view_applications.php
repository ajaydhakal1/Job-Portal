<?php include ('./includes/db.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <title>View Applications</title>
</head>

<body>
<?php include './includes/navbar.php'; ?>

    <div class="container">
        <h1 class="mt-5">Applications for Job</h1>
        <?php
        $job_id = $_GET['id'];
        $sql = "SELECT * FROM applications WHERE job_id = $job_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Resume</th>
                            <th>Application Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $row["name"] . '</td>
                        <td>' . $row["email"] . '</td>
                        <td><a href="' . $row["resume"] . '" target="_blank" class="btn btn-outline-primary btn-sm">View Resume</a></td>
                        <td>' . $row["application_date"] . '</td>
                        <td>
                            <a href="delete_application.php?id=' . $row["id"] . '&job_id=' . $job_id . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this application?\')">Delete</a>
                        </td>
                      </tr>';
            }
            echo '</tbody>
                </table>';
        } else {
            echo "No applications found for this job.";
        }
        $conn->close();
        ?>
        <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
    </div>

    <?php include './includes/footer.php' ?>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>
