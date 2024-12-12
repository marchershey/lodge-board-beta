<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Text extends Component
{
    public $wiremodel;
    public $wiremodeltype;
    public $wiretarget;
    public $label;
    public $desc;
    public $placeholder;
    public $type;
    public $autocomplete;
    public $onfocus;
    public $required;
    public $hideAsterisk;

    /**
     * Create a new component instance.
     */
    public function __construct(string $wiremodel, string $wiremodeltype = 'blur', ?string $wiretarget = null, ?string $label = null, ?string $desc = null, ?string $placeholder = null, string $type = 'text', ?string $autocomplete = null, ?string $onfocus = null, bool $required = false, bool $hideAsterisk = false)
    {
        $this->wiremodel = $wiremodel;
        $this->wiremodeltype = $wiremodeltype;
        $this->wiretarget = $wiretarget;
        $this->label = $label;
        $this->desc = $desc;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->autocomplete = $autocomplete;
        $this->onfocus = $onfocus;
        $this->required = $required;
        $this->hideAsterisk = $hideAsterisk;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Closure|View|string
    {
        return view('components.forms.text');
    }
}
