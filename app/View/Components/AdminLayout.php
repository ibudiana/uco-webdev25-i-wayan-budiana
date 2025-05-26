<?php

// namespace App\View\Components;

// use Closure;
// use Illuminate\Contracts\View\View;
// use Illuminate\View\Component;

// class AdminLayout extends Component
// {
//     /**
//      * Create a new component instance.
//      */
//     public function __construct()
//     {
//         //
//     }

//     /**
//      * Get the view / contents that represent the component.
//      */
//     public function render(): View|Closure|string
//     {
//         return view('components.admin-layout');
//     }
// }

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.admin');
    }
}
