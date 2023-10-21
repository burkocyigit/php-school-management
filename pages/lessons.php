<?php
require_once '../includes/config_session.inc.php';
require_once '../models/lesson_model.php';
require_once '../models/teacher_model.php';
require_once '../includes/dbh.inc.php';
$lessons = get_lesson_data($pdo);
$teachers = get_teacher_data($pdo);
$teacher_names = get_teachers_with_lessons($pdo);
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
    ?>

    <div class="content">
        <table id="myTable" class="display">

            <label for="classes">Filter with teacher:</label>

            <select name="teachers" id="teachers">
                <option value="all">All</option>
                <?php foreach ($teacher_names as $teacher): ?>
                <option value="<?= $teacher['name'] ?>">
                    <?= $teacher['name'] ?>
                </option>
                <?php endforeach; ?>
            </select>

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Teacher</th>
                    <th>⚙️</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessons as $lesson): ?>
                <tr>
                    <td>
                        <?= $lesson['lesson_name'] ?>
                    </td>
                    <td>
                        <?= $lesson['teacher_name'] ?>
                    </td>
                    <td>
                        <form action="lesson_operations.php" method="POST">
                            <input type="hidden" name="id" value="<?= $lesson['id'] ?>">
                            <input type="hidden" name="lesson_name" value="<?= $lesson['lesson_name'] ?>">
                            <input type="hidden" name="username" value="<?= $lesson['username'] ?>">
                            <button type="submit" class="btn btn-dark">Edit</button>
                        </form>
                        <form action="../includes/lesson_operations.inc.php" method="POST">
                            <input type="hidden" name="delete" value="<?= $lesson['id'] ?>">
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

    var filterDropdown = document.querySelector('#teachers');

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