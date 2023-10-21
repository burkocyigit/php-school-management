<?php
require_once '../includes/config_session.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="../css/style.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
</head>

<body>
    <?php
    include '../includes/sidebar.inc.php';
    require_once '../includes/dbh.inc.php';
    require_once '../models/student_model.php';
    require_once '../views/student_details_view.php';

    require_once '../views/teacher_details_view.php';


    ?>

    <div class="content">
        <div class="container">
            <?php
            if (isset($_GET['operation']) && $_GET['operation'] === 'success') {
                output_success(true);
            }
            ?>

            <form action="../includes/teacher_operations.inc.php" class="form-group" method="POST">
                <h3>Add Teacher</h3>
                <label for="teacherName">Name</label>
                <input class="form-control" required type="text" name="name" id="name">

                <label for="teacherSurname">Surname</label>
                <input class="form-control" required type="text" name="surname" id="surname">

                <label for="teacherUsername">Username</label>
                <input class="form-control" required type="text" name="username" id="username">

                <label for="teacherPassword">Password</label>
                <input class="form-control" required type="password" name="password" id="pwd">

                <button class="btn btn-primary mt-2">Add Teacher</button>
            </form>
            <hr class="hr hr-blurry" />
            <?php
            if (isset($_GET['result']) && $_GET['result'] === 'false') {
                output_success(false);
            } ?>

            <hr class="hr hr-blurry" />

            <?php
            if (isset($_POST['username'])) { ?>
                <hr class="hr hr-blurry" />
                <form action="../includes/teacher_operations.inc.php" class="form-group" method="POST">
                    <h3>Update Teacher</h3>
                    <label for="username">Current username of the teacher</label>
                    <input required type="text" readonly class="form-control" name="teacherUsername" id="teacherUsername"
                        value="<?= $_POST['username'] ?>">

                    <label for="username">Update Username</label>
                    <input required type="text" class="form-control" name="updatedUsername"
                        value="<?= $_POST['username'] ?>">

                    <label for="username">Update Name</label>
                    <input required type="text" class="form-control" name="updatedName" value="<?= $_POST['name'] ?>">

                    <label for="username">Update Surname</label>
                    <input required type="text" class="form-control" name="updatedSurname" value="<?= $_POST['surname'] ?>">

                    <?php
                    if ($_SESSION['role'] === 'admin') { ?>
                        <label for="password">Update Password</label>
                        <input type="password" class="form-control" name="updatedPassword">
                    <?php }
                    ?>

                    <button class="btn btn-primary mt-2">Update</button>
                    <hr class="hr hr-blurry" />

                </form>
            <?php } ?>
        </div>
    </div>
</body>

</html>