<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toggle extends Component
{
    public $wiremodel;
    public $label;
    public $desc;

    /**
     * Create a new component instance.
     */
    public function __construct(string $wiremodel, string $label, string $desc = null)
    {
        $this->wiremodel = $wiremodel;
        $this->label = $label;
        $this->desc = $desc;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.toggle');
    }
}
