<?php

namespace App\Virtual\Models;

use OpenApi\Attributes as OA;

#[OA\Schema(title: 'Employee', description: 'Employee details')]
class Employee
{
    #[OA\Property(description: 'ID of the employee', format: 'int64')]
    public int $id;

    #[OA\Property(description: 'First Name of the employee', format: 'string')]
    public string $first_name;

    #[OA\Property(description: 'Last Name of the employee', format: 'string')]
    public string $last_name;

}
