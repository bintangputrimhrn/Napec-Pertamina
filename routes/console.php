<?php

use Illuminate\Support\Facades\Schedule;

// Optional Hostinger cron-friendly queue processing:
// * * * * * php /path/to/project/artisan queue:work --stop-when-empty --tries=3

Schedule::command('sheets:sync')->everyFiveMinutes()->withoutOverlapping();
