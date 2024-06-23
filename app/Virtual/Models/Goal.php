<?php

namespace App\Virtual\Models;

use OpenApi\Attributes as OA;

#[OA\Schema(title: 'Goal', description: 'Goal')]
class Goal
{
    #[OA\Property(description: 'ID of the goal', format: 'int64')]
    public int $id;

    #[OA\Property(description: 'Name of the goal', format: 'string')]
    public string $name;

}
