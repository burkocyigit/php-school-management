<?php
require_once '../includes/config_session.inc.php';
require_once '../models/exam_model.php';
require_once '../models/lesson_model.php';
require_once '../models/student_model.php';
require_once '../models/class_model.php';
require_once '../includes/dbh.inc.php';

$classes = get_class_data($pdo);
$lessons = get_lesson_data($pdo);
$students = get_student_data($pdo);
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
    require_once '../models/exam_model.php';
    require_once '../views/student_details_view.php';
    require_once '../views/exam_details_view.php';


    ?>

    <div class="content">
        <div class="container">
            <?php
            if (isset($_GET['operation']) && $_GET['operation'] === 'success') {
                output_success(true);
            }
            ?>

            <form action="../includes/exam_operations.inc.php" class="form-group" method="POST">
                <h3>Add Exam</h3>
                <input type="hidden" name="add">
                <h2>Student</h2>
                <select name="students" id="classes">
                    <?php foreach ($students as $lesson): ?>
                        <option value="<?= $lesson['id'] ?>">
                            <?= $lesson['name'] . " " . $lesson['surname'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <h2><label for="class">Class</label></h2>
                <select name="classes" id="classes">
                    <?php foreach ($classes as $class): ?>
                        <option value="<?= $class['class_id'] ?>">
                            <?= $class['class_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <h2><label for="">Lesson</label></h2>

                <select name="lessons" id="classes">
                    <?php foreach ($lessons as $lesson): ?>
                        <option value="<?= $lesson['id'] ?>">
                            <?= $lesson['lesson_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <h2><label for="score">Score</label></h2>
                <input type="text" class="form-control" name="score">

                <label for="examDate">Exam Date</label>
                <input type="date" name="examDate" id="">

                <button class="btn btn-primary mt-2">Add Exam</button>
            </form>
            <?php
            if (isset($_POST['id'])) { ?>
                <hr class="hr hr-blurry" />
                <form action="../includes/exam_operations.inc.php" class="form-group" method='POST'>
                    <h3>Update Exam</h3>
                    <input type="hidden" name="update" value="true">
                    <label for="date">Exam Date</label>
                    <input readonly type="date" class="form-control" name="exam_date" value="<?= $_POST['exam_date'] ?>">
                    <label for="date">Class Name</label>
                    <input readonly type="text" class="form-control" name="class_name" value="<?= $_POST['class_name'] ?>">
                    <label for="date">Student</label>
                    <input readonly type="text" class="form-control" name="student_name"
                        value="<?= $_POST['student_name'] ?>">
                    <label for="date">Lesson</label>
                    <input readonly type="text" class="form-control" name="lesson_name"
                        value="<?= $_POST['lesson_name'] ?>">
                    <label for="date">Score</label>
                    <input type="text" class="form-control" name="newScore" value="<?= $_POST['score'] ?>">
                    <input type="hidden" name="exam_id" value="<?= $_POST['id'] ?>">
                    <button class="btn btn-primary mt-2">Update</button>
                </form>
            <?php }

            ?>
            <?php
            if (isset($_GET['result']) && $_GET['result'] === 'false') {
                output_success(false);
            } ?>
            <hr class="hr hr-blurry" />
        </div>
    </div>
</body>

</html>