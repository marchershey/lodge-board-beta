<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Minimal extends Component
{
    public string $title;
    public bool $header;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title, bool $header = true)
    {
        $this->title = $title;
        $this->header = $header;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Closure|View|string
    {
        return view('layouts.minimal');
    }
}
