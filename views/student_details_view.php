<?php

declare(strict_types=1);

function output_student(array $students)
{
    echo <<<END
        <table class="table table-dark">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Class</th>
                </tr>
            </thead>
        <tbody>
            <tr>
            
                <td>{$students['student_name']}</td>
                <td>{$students['student_surname']}</td>
                <td>{$students['student_class']}</td>
            </tr>
        </tbody>
    </table>

    END;
}

function output_this_student(array $student)
{
    echo <<<END
    <h3>Student Info</h3>
    <table class="table table-dark">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <th scope="col">Class</th>
            </tr>
        </thead>
    <tbody>
        <tr>
        
            <td>{$student['name']}</td>
            <td>{$student['surname']}</td>
            <td>{$student['class']}</td>
        </tr>
    </tbody>
</table>

END;
}

function output_this_student_exams(array $exams)
{
    echo '
    <hr class="hr hr-blurry" />
    <h3>Exam History</h3>
        <table class="table table-dark">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Exam Date</th>
                <th scope="col">Exam Score</th>
                <th scope="col">Lesson</th>
                <th scope="col">Lesson Score Average</th>
                </tr>
            </thead>
        <tbody>';

    foreach ($exams as $exam) {
        echo "<tr>
                <td>{$exam['exam_date']}</td>
                <td>{$exam['exam_score']}</td>
                <td>{$exam['lesson_name']}</td>
                <td>{$exam['lesson_average']}</td>
                </tr>";
    }

    echo "
    </tbody>
</table>";
}

function output_student_class(array $student)
{
    echo <<<END
    <table class="table table-dark">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <th scope="col">Class</th>
            </tr>
        </thead>
    <tbody>
        <tr>
        
            <td>{$student['student_name']}</td>
            <td>{$student['student_surname']}</td>
            <td>{$student['class_name']}</td>
        </tr>
    </tbody>
</table>

END;
}

function output_student_exams(array $exams)
{
    echo <<<END
    <table class="table table-dark">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Exam Date</th>
            <th scope="col">Score</th>
            <th scope="col">Lesson</th>
            <th scope="col">Average</th>
            </tr>
        </thead>
    <tbody>
        <tr>
        
            <td>{$exams['exam_date']}</td>
            <td>{$exams['exam_score']}</td>
            <td>{$exams['lesson_name']}</td>
            <td>{$exams['student_average']}</td>
        </tr>
    </tbody>
</table>

END;
}

function output_success(bool $b)
{

    if ($b) {
        echo '<div class="container alert alert-success text-center" role="alert" id="success-alert">' .
            'Success.' .
            '</div>';
    } else {
        echo '<div class="container alert alert-warning text-center" role="alert" id="success-alert">' .
            'Failed.' .
            '</div>';
    }

}