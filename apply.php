<?php include ('./includes/db.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <title>Apply for Job</title>
</head>

<body>
<?php include './includes/navbar.php'; ?>

    <div class="container">
        <h1 class="mt-5">Apply for Job</h1>
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
                <form action="submit_application.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="job_id" value="' . $id . '">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="resume" class="form-label">Your Resume</label>
                        <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Application</button>
                </form>
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
