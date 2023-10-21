<?php
require_once 'dbh.inc.php';
require_once '../models/student_model.php';
require_once '../models/teacher_model.php';
require_once '../models/class_model.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
        <div class="card-header">Students</div>
        <div class="card-body text-center">
            <h5 class="card-title">Number of your students:</h5>
            <h3 class="card-text">
                <?php echo get_teacher_students($pdo, $_SESSION['id']); ?>
            </h3>
        </div>
    </div>

    <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
        <div class="card-header">Average</div>
        <div class="card-body text-center">
            <h5 class="card-title">Grade Point Average of your class:</h5>
            <h3 class="card-text">
                <?php echo get_teacher_students_average($pdo, $_SESSION['id']) ?>
            </h3>
        </div>
    </div>
</body>

</html>