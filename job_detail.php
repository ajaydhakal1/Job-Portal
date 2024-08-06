<?php include ('./includes/db.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        .buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
    <title>Job Details</title>
</head>

<body>
<?php include './includes/navbar.php'; ?>

    <div class="container">
        <h1 class="mt-5">Job Details</h1>
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM jobs WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">' . $row["title"] . '</h5>
                <p class="card-text">' . $row["description"] . '</p>
                <p><strong>Company:</strong> ' . $row["company"] . '</p>
                <p><strong>Location:</strong> ' . $row["location"] . '</p>
                <p><strong>Salary:</strong> Rs.' . $row["salary"] . '</p>
                <p><strong>Posted At:</strong> ' . $row["posted_date"] . '</p>
                <p><strong>Application Deadline:</strong> ' . $row["application_deadline"] . '</p>
                <div class="buttons">
                <a href="apply.php?id=' . $id . '" class="btn btn-primary">Apply for Job</a>
                <a href="view_applications.php?id=' . $id . '" class="btn btn-outline-danger">View Applications</a>
                <a href="edit_job.php?id=' . $row["id"] . '" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>';
        } else {
            echo "Job not found";
        }
        $conn->close();
        ?>
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