<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;
#[OA\Info(version: '1.0.0', description: 'Ostendi Test', title: 'TEST API')]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    bearerFormat: 'JWT',
    scheme: 'bearer'
)]
abstract class Controller
{
    //
}
