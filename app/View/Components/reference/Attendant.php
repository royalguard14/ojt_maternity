<?php

namespace App\View\Components\Reference;

use App\Helpers\RefDataHelper;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Attendant extends Component
{
    public $attendants;
    public $selected;

    /**
     * Create a new component instance.
     */
    public function __construct($ref = 'RAttendant', $selected = null)
    {
        $this->attendants = RefDataHelper::loadRefFile($ref);
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reference.attendant');
    }
}
