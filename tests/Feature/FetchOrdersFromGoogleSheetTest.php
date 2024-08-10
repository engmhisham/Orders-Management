<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Jobs\FetchOrdersFromGoogleSheet;

class FetchOrdersFromGoogleSheetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_fetches_orders_from_google_sheet()
    {
        // Dispatch job
        FetchOrdersFromGoogleSheet::dispatch();

        // Assert that the orders are fetched and stored in the database
        $this->assertDatabaseHas('orders', [
            'order_id' => '001',
            'client_name' => 'John Doe',
        ]);
    }
}
