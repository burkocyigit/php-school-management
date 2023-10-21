<?php

declare(strict_types=1);

function output_class(array $class)
{
    echo <<<END
        <table class="table table-dark">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Teacher</th>
                
                </tr>
            </thead>
        <tbody>
            <tr>
            
                <td>{$class['class_name']}</td>
                <td>{$class['class_teacher_id']}</td>
            
            </tr>
        </tbody>
    </table>

    END;
}