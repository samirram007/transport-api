<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Dashboard\StoreDashboardRequest;
use App\Http\Requests\Dashboard\UpdateDashboardRequest;
use App\Http\Resources\SuccessResource;
use App\Services\IDashboardService;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(IDashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $response = $this->dashboardService->getAll();

        return $response;
    }

}
