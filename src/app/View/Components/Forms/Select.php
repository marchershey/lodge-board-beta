<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $options;
    public $wiremodel;
    public $label;
    public $desc;
    public $placeholder;
    public $class;


    // //////////////////////////////
    // public $options = null;
    // public $wiremodel;
    // public $label;
    // public $desc;
    // public $placeholder;
    // public $class;
    // public $selected;

    /**
     * Create a new component instance.
     */
    // public function __construct(array $options, string $wiremodel, string $label = "", string $desc = "", string $placeholder = "", string $class = "")
    public function __construct(array $options, string $wiremodel, string $label, string $desc = "", string $placeholder = null)
    {
        $this->options = $options ?? [];
        $this->wiremodel = $wiremodel;
        $this->label = $label ?? 'Select';
        $this->desc = $desc;
        $this->placeholder = $placeholder ?? 'Select an option...';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.select');
    }
}
