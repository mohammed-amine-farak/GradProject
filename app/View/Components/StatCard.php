<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatCard extends Component
{
    public $icon;
    public $value;
    public $label;
    public $change;
    public $delay;

    public function __construct($icon, $value, $label, $change, $delay = 0)
    {
        $this->icon = $icon;
        $this->value = $value;
        $this->label = $label;
        $this->change = $change;
        $this->delay = $delay;
    }

    public function render(): View|Closure|string
    {
        return view('components.stat-card');
    }
}