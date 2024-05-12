<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Spinner extends Component
{
    public $wiretarget;
    public $size;
    public $color;

    /**
     * Create a new component instance.
     */
    public function __construct(string $wiretarget = "", string $size = "w-5 h-5", string $color = "text-muted")
    {
        $this->wiretarget = $wiretarget;
        $this->size = $size;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.spinner');
    }
}
