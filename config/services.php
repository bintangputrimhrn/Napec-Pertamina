<?php

return [
    'google' => [
        'sheets_spreadsheet_id' => env('GOOGLE_SHEETS_SPREADSHEET_ID'),
        'sheets_range' => env('GOOGLE_SHEETS_RANGE', 'Feedback!A:U'),
        'credentials_path' => env('GOOGLE_SHEETS_CREDENTIALS_PATH', storage_path('app/google/credentials.json')),
    ],
];
