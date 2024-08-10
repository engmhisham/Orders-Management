<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class OrdersTable extends Component
{
    public $search = '';

    public function updatedSearch($value)
    {
        $this->validate([
            'search' => 'string|max:255',
        ]);
    }

    public function render()
    {
        $orders = Order::where('phone_number', 'like', "%{$this->search}%")
                       ->orWhere('client_name', 'like', "%{$this->search}%")
                       ->get();

        return view('livewire.orders-table', ['orders' => $orders]);
    }
}

