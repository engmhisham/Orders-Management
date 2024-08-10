<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Http\Livewire\OrdersTable;
use App\Models\Order;

class OrdersTableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_orders_based_on_search_query()
    {
        // Create test orders
        Order::factory()->create([
            'phone_number' => '1234567890',
            'client_name' => 'John Doe',
        ]);

        // Test Livewire component
        Livewire::test(OrdersTable::class)
            ->set('search', 'John Doe')
            ->assertSee('John Doe');
    }
}
