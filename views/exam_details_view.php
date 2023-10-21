<?php

declare(strict_types=1);

function output_exams(array $exam)
{
    echo <<<END
        <table class="table table-dark">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Date</th>
                <th scope="col">Class Name</th>
                <th scope="col">Student Name</th>
                <th scope="col">Student Surname</th>
                <th scope="col">Lesson Name</th>
                <th scope="col">Lesson Average Score</th>
                
                </tr>
            </thead>
        <tbody>
            <tr>
            
                <td>{$exam['']}</td>
                <td>{$exam['']}</td>
                <td>{$exam['']}</td>
                <td>{$exam['']}</td>
                <td>{$exam['']}</td>
                <td>{$exam['']}</td>
            </tr>
        </tbody>
    </table>

    END;
}