<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $user = auth()->user();

        if ($user && $user->isSuperAdmin()) {
            return view('layouts.admin.app');
        }

        if ($user && $user->isPartner()) {
            return view('layouts.partner.app');
        }

        return view('layouts.member.app');
    }
}
