<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Logo extends Component
{
    public $hideIcon;
    public $hideText;
    public $hideBuild;
    public $bgDark;
    public $bgThemeSwitch; // Background color changes from light to dark or dark to light on theme switch
    public $textSize;
    public $iconSize;

    /**
     * Create a new component instance.
     */
    public function __construct(bool $hideIcon = false, bool $hideText = false, bool $hideBuild = false, bool $bgDark = false, bool $bgThemeSwitch = false, string $textSize = "text-3xl", string $iconSize = "w-6 h-6")
    {
        $this->hideIcon = $hideIcon;
        $this->hideText = $hideText;
        $this->hideBuild = $hideBuild;
        $this->bgDark = $bgDark;
        $this->bgThemeSwitch = $bgThemeSwitch;
        $this->textSize = $textSize;
        $this->iconSize =  $iconSize;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.logo');
    }
}
