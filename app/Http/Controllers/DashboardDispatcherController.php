<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Partner\DashboardController as PartnerDashboardController;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardDispatcherController extends Controller
{
    /**
     * Dispatch user to their role-specific dashboard view.
     */
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        if ($user && $user->isSuperAdmin()) {
            return app(AdminDashboardController::class)->index();
        }

        if ($user && $user->isPartner()) {
            return app(PartnerDashboardController::class)->index($request);
        }

        return app(MemberDashboardController::class)->index($request);
    }
}
