@php
    $user = Auth::user();
    if ($user && $user->isSuperAdmin()) {
        $layout = 'layouts.admin.app';
    } elseif ($user && $user->isPartner()) {
        $layout = 'layouts.partner.app';
    } else {
        $layout = 'layouts.member.app';
    }
@endphp
@include($layout, ['slot' => $slot])

