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

    // Since the "options" are a Key/Value pair, when the user makes a selection, 
    // we can either display the Key as the selected text, or display the Value
    // as the selected text. By default, the Value of the Key/Value pair is shown
    // when the user makes their selection. By setting this to true, it will 
    // show the Key of the Key/Value pair as the selected text. You can also just
    // Add 'showKeyAsSelection' to the element to set at true.
    public $showKeyAsSelection;


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
    public function __construct(array $options, string $wiremodel, string $label, string $desc = "", string $placeholder = null, bool $showKeyAsSelection = false)
    {
        $this->options = $options ?? [];
        $this->wiremodel = $wiremodel;
        $this->label = $label ?? 'Select';
        $this->desc = $desc;
        $this->placeholder = $placeholder ?? 'Select an option...';
        $this->showKeyAsSelection = $showKeyAsSelection;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.select');
    }
}
