<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('invitations:purge-expired')
    ->daily()
    ->withoutOverlapping()
    ->appendOutputTo(storage_path('logs/purge-expired.log'));
