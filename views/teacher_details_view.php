<?php

declare(strict_types=1);

function output_teacher(array $teacher)
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
            
                <td>{$teacher['name']}</td>
                <td>{$teacher['surname']}</td>
                <td>{$teacher['username']}</td>
            </tr>
        </tbody>
    </table>

    END;
}