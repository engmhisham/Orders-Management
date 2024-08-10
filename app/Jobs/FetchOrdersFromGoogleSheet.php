<?php

namespace App\Jobs;

use App\Services\GoogleSheetsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class FetchOrdersFromGoogleSheet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ordersSpreadsheetId;
    protected $productsSpreadsheetId;

    public function __construct($ordersSpreadsheetId, $productsSpreadsheetId)
    {
        $this->ordersSpreadsheetId = $ordersSpreadsheetId;
        $this->productsSpreadsheetId = $productsSpreadsheetId;
    }

    public function handle()
    {
        $sheetsService = new GoogleSheetsService();

        // Fetch orders data
        $orders = $sheetsService->getSheetData($this->ordersSpreadsheetId, 'Orders!A:F');
        foreach ($orders as $order) {
            if (isset($order[0])) {
                DB::table('orders')->updateOrInsert(
                    ['order_id' => $order[0]],
                    [
                        'client_name' => $order[1],
                        'phone_number' => $order[2],
                        'product_code' => $order[3],
                        'final_price' => $order[4],
                        'quantity' => $order[5]
                    ]
                );
            }
        }

        // Fetch products data
        $products = $sheetsService->getSheetData($this->productsSpreadsheetId, 'Products!A:D');
        foreach ($products as $product) {
            if (isset($product[0])) {
                DB::table('products')->updateOrInsert(
                    ['product_code' => $product[3]],
                    [
                        'product_name' => $product[0],
                        'description' => $product[1],
                        'country' => $product[2]
                    ]
                );
            }
        }
    }
}
