<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
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
    public int $cols;
    public int $rows;
    public int $maxlength;

    /**
     * Create a new component instance.
     */
    public function __construct($wiremodel, $wiremodeltype = "blur", $wiretarget = null, string $label = null, string $desc = null, string $placeholder = null, string $type = "text", string $autocomplete = null, string $onfocus = null, bool $required = false, bool $hideAsterisk = false, int $rows = 4, int $cols = 0, int $maxlength = 0)
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
        $this->cols = $cols;
        $this->rows = $rows;
        $this->maxlength = $maxlength;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.textarea');
    }
}
