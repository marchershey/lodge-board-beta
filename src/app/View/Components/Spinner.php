<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Spinner extends Component
{
    public $wiretarget;

    /**
     * Create a new component instance.
     */
    public function __construct(string $wiretarget)
    {
        $this->wiretarget = $wiretarget;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.spinner');
    }
}
