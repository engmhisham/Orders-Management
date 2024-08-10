<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\FetchOrdersFromGoogleSheet;

class FetchGoogleSheetData extends Command
{
    protected $signature = 'fetch:google-sheets';
    protected $description = 'Fetch data from Google Sheets and store it in the database.';

    public function handle()
    {
        FetchOrdersFromGoogleSheet::dispatch(
            env('GOOGLE_ORDERS_SPREADSHEET_ID'),
            env('GOOGLE_PRODUCTS_SPREADSHEET_ID')
        );

        $this->info('Google Sheets data fetch job dispatched.');
    }
}
