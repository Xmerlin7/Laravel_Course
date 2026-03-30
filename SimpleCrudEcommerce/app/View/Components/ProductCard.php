<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    public $name;
    public $price;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.product-card');
    }
}
