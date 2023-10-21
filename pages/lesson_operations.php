<?php
require_once '../includes/config_session.inc.php';
require_once '../models/teacher_model.php';
require_once '../includes/dbh.inc.php';
$teachers = get_all_teachers($pdo);
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
    require_once '../models/lesson_model.php';
    require_once '../views/student_details_view.php';


    ?>

    <div class="content">
        <div class="container">
            <?php
            if (isset($_GET['operation']) && $_GET['operation'] === 'success') {
                output_success(true);
            }
            ?>

            <form action="../includes/lesson_operations.inc.php" class="form-group" method="POST">
                <h3>Add Lesson</h3>
                <label for="lessonName">Name</label>
                <input class="form-control" required type="text" name="name" id="name">

                <label for="teacherName">Teacher</label>
                <select name="teacher" id="teacher">
                    <option value="all">All</option>
                    <?php foreach ($teachers as $teacher): ?>
                    <option value="<?= $teacher['id'] ?>">
                        <?= $teacher['name'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>

                <button class="btn btn-primary mt-2">Add Lesson</button>
            </form>
            <hr class="hr hr-blurry" />
            <?php
            if (isset($_GET['result']) && $_GET['result'] === 'false') {
                output_success(false);
            } ?>

            <?php
            if (isset($_POST['id'])) { ?>
            <hr class="hr hr-blurry" />
            <form action="../includes/lesson_operations.inc.php" class="form-group" method="POST">
                <h3>Update Lesson</h3>
                <label for="username">Update Lesson Name</label>
                <input type="hidden" name="id" value="<?= $_POST['id'] ?>">
                <input required type="text" class="form-control" name="updatedLessonName"
                    value="<?= $_POST['lesson_name'] ?>">

                <?php
                    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
                <label for="username">Update Lesson Teacher Username</label>
                <input required type="text" class="form-control" name="updatedTeacherUsername"
                    value="<?= $_POST['username'] ?>">
                <?php }
                    ?>

                <button class="btn btn-primary mt-2">Update</button>
                <hr class="hr hr-blurry" />

            </form>
            <?php }
            ?>

        </div>
    </div>
</body>

</html>