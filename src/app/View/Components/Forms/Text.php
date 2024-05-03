<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Text extends Component
{
    public $wiremodel;
    public $wiretarget;
    public $label;
    public $desc;
    public $placeholder;
    public $type;
    public $autocomplete;
    public $class;
    public $onfocus;

    /**
     * Create a new component instance.
     */
    public function __construct(string $wiremodel, string $wiretarget = null, string $label = null, string $desc = null, string $placeholder = null, string $type = "text", string $autocomplete = null, string $class = null, string $onfocus = null)
    {
        $this->wiremodel = $wiremodel;
        $this->wiretarget = $wiretarget;
        $this->label = $label;
        $this->desc = $desc;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->autocomplete = $autocomplete;
        $this->class = $class;
        $this->onfocus = $onfocus;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.text');
    }
}
