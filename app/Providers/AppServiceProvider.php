<?php

namespace App\Providers;

use App\Services\IFeeService;
use App\Services\IAuthService;
use App\Services\ISlotService;
use App\Services\IUserService;
use App\Services\IRiderService;
use App\Services\ISchoolService;
use App\Services\IExpenseService;
use App\Services\IFeeHeadService;
use App\Services\impl\FeeService;
use App\Services\IVehicleService;
use App\Services\impl\AuthService;
use App\Services\impl\SlotService;
use App\Services\impl\UserService;
use App\Services\IDashboardService;
use App\Services\impl\RiderService;
use App\Services\IFiscalYearService;
use App\Services\impl\SchoolService;
use App\Services\IExpenseHeadService;
use App\Services\IIncomeGroupService;
use App\Services\impl\ExpenseService;
use App\Services\impl\FeeHeadService;
use App\Services\impl\VehicleService;
use App\Services\IVehicleTypeService;
use App\Services\IExpenseGroupService;
use App\Services\IOrganizationService;
use App\Services\impl\DashboardService;
use Illuminate\Support\ServiceProvider;
use App\Services\impl\FiscalYearService;
use App\Services\impl\ExpenseHeadService;
use App\Services\impl\IncomeGroupService;
use App\Services\impl\VehicleTypeService;
use App\Services\impl\ExpenseGroupService;
use App\Services\impl\OrganizationService;
use App\Services\IUserInitialValueService;
use App\Services\impl\UserInitialValueService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(IDashboardService::class, DashboardService::class);
        $this->app->bind(IFiscalYearService::class, FiscalYearService::class);
        $this->app->bind(IExpenseGroupService::class, ExpenseGroupService::class);
        $this->app->bind(IExpenseHeadService::class, ExpenseHeadService::class);
        $this->app->bind(IExpenseService::class, ExpenseService::class);

        $this->app->bind(IIncomeGroupService::class, IncomeGroupService::class);
        $this->app->bind(IFeeHeadService::class, FeeHeadService::class);
        $this->app->bind(IFeeHeadService::class, FeeHeadService::class);
        $this->app->bind(IFeeService::class, FeeService::class);

        $this->app->bind(IRiderService::class, RiderService::class);
        $this->app->bind(ISchoolService::class, SchoolService::class);
        $this->app->bind(ISlotService::class, SlotService::class);
        $this->app->bind(IOrganizationService::class, OrganizationService::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IUserInitialValueService::class, UserInitialValueService::class);
        $this->app->bind(IVehicleTypeService::class, VehicleTypeService::class);
        $this->app->bind(IVehicleService::class, VehicleService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
