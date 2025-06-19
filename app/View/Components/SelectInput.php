<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectInput extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $name;
    public $options;
    public $value;
    public $required;
    public $disabled;

    public function __construct($id,  $name, $options = [], $value = null, $required = false, $disabled = false)
    {
        $this->id = $id;
        $this->name = $name;
        $this->options = $options;
        $this->value = $value;
        $this->required = $required;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-input');
    }
}
