<?php
require_once '../includes/config_session.inc.php';
require_once '../models/exam_model.php';
require_once '../includes/dbh.inc.php';

$exams = get_exam_data($pdo);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <?php include '../includes/sidebar.inc.php';
    require_once '../includes/dbh.inc.php';
    ?>

    <div class="content">
        <table id="myTable" class="display">

            <label for="classes">Filter with class:</label>

            <select name="classes" id="classes">
                <option value="all">All</option>
                <?php foreach ($exams as $exam): ?>
                <option value="<?= $exam['class_name'] ?>">
                    <?= $exam['class_name'] ?>
                </option>
                <?php endforeach; ?>
            </select>


            <thead>
                <tr>
                    <th>Exam Date</th>
                    <th>Class Name</th>
                    <th>Student Name</th>
                    <th>Student Surname</th>
                    <th>Lesson Name</th>
                    <th>Lesson Average Score</th>
                    <th>⚙️</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($exams as $exam): ?>
                <tr>
                    <td>
                        <?= $exam['exam_date'] ?>
                    </td>
                    <td>
                        <?= $exam['class_name'] ?>
                    </td>
                    <td>
                        <?= $exam['student_name'] ?>
                    </td>
                    <td>
                        <?= $exam['student_surname'] ?>
                    </td>
                    <td>
                        <?= $exam['lesson_name'] ?>
                    </td>
                    <td>
                        <?= $exam['average_lesson_grades'] ?>
                    </td>
                    <td>
                        <form action="exam_operations.php" method="POST">
                            <input type="hidden" name="id" value="<?= $exam['id'] ?>">
                            <input type="hidden" name="student_id" value="<?= $exam['student_id'] ?>">
                            <input type="hidden" name="lesson_id" value="<?= $exam['lesson_id'] ?>">
                            <input type="hidden" name="exam_date" value="<?= $exam['exam_date'] ?>">
                            <input type="hidden" name="class_name" value="<?= $exam['class_name'] ?>">
                            <input type="hidden" name="student_name" value="<?= $exam['student_name'] ?>">
                            <input type="hidden" name="student_surname" value="<?= $exam['student_surname'] ?>">
                            <input type="hidden" name="lesson_name" value="<?= $exam['lesson_name'] ?>">
                            <input type="hidden" name="score" value="<?= $exam['score'] ?>">
                            <input type="hidden" name="class_id" value="<?= $exam['class_id'] ?>">
                            <button type="submit" class="btn btn-dark">Edit</button>
                        </form>
                        <form action="../includes/exam_operations.inc.php" method="POST">
                            <input type="hidden" name="id" value="<?= $exam['id'] ?>">
                            <button type="submit" class="btn btn-dark">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php include '../includes/profile_button.inc.php'; ?>
    </div>

    <script>
    let table = new DataTable('#myTable');
    var filterDropdown = document.querySelector('#classes');

    filterDropdown.addEventListener('change', function() {
        var selectedCategory = this.value;
        if (selectedCategory != 'all') {
            table.column(1).search(selectedCategory).draw();
        } else {
            table.column(1).search('').draw();
        }
    });
    </script>
</body>

</html>