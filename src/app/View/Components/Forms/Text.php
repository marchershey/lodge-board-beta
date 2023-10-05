<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Text extends Component
{
    public $wiremodel;
    public $label;
    public $desc;
    public $placeholder;
    public $type;
    public $autocomplete;
    public $class;

    /**
     * Create a new component instance.
     */
    public function __construct(string $wiremodel, string $label = "", string $desc = "", string $placeholder = "", string $type = "text", string $autocomplete = "", string $class = "")
    {
        $this->wiremodel = $wiremodel;
        $this->label = $label;
        $this->desc = $desc;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->autocomplete = $autocomplete;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.text');
    }
}
