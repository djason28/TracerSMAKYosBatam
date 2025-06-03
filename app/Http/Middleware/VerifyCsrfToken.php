<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        '/login',
        '/register',
        '/dashboard/admin/addform', // kalau form ini POST dan kamu test di Postman
        '/api'
    ];
}
