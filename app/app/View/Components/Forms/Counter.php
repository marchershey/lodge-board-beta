<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Counter extends Component
{

    // public $wiremodel;
    // public $wiretarget;
    // public $label;
    // public $desc;
    // public $step;
    // public $min;
    // public $max;
    // public $required;

    /**
     * Create a new component instance.
     */
    // public function __construct(string $wiremodel, string $wiretarget = null, string $label = null, string $desc = "", float $step = 1, int $min = 0, int $max = 99, bool $required = false)
    public function __construct()
    {
        // $this->wiremodel = $wiremodel;
        // $this->wiretarget = $wiretarget;
        // $this->label = $label;
        // $this->desc = $desc;
        // $this->step = $step;
        // $this->min = $min;
        // $this->max = $max;
        // $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.counter');
    }
}
