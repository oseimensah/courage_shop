<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Checkout extends Component
{
    public $order;
    public function render()
    {
        return view('livewire.checkout');
    }

    public function mount($order)
    {
        $this->order = $order;
    }

    protected $rules = [
        'customer_name' => 'required|string|min:6',
        'customer_email' => 'required|email',
        'customer_phone' => 'required|digits_between:9,12|min:9',
        'card_name' => 'nullable|string',
        'card_number' => 'nullable|string|min:16',
        'card_month' => 'nullable|numeric|digits:2|min:1|max:12',
        'card_year' => 'nullable|numeric|digits:2|min:20',
        'card_cvv' => 'nullable|numeric|digits:3',
        'mobile_phone' => 'nullable|digits_between:9,12|min:9',
        'mobile_vocher' => 'nullable|numeric',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
