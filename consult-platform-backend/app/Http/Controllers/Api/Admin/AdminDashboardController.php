<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AdminDashboardController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'total_users' => User::count(),
            'professionals' => User::whereHas('roles', fn ($q) => $q->where('name', 'professional'))->count(),
            'clients' => User::whereHas('roles', fn ($q) => $q->where('name', 'client'))->count(),
        ]);
    }   
}
