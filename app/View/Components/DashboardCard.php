<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $type, $value, $icon, $label;
    public function __construct($type, $value, $icon, $label)
    {
        $this->type = $type;
        $this->value = $value;
        $this->icon = $icon;
        $this->label = $label;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-card');
    }
}
