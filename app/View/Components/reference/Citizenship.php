<?php

namespace App\View\Components\reference;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Helpers\RefDataHelper;

class Citizenship extends Component
{
    public $ref;
    public $selected;

    /**
     * Create a new component instance.
     *
     * @param  string  $ref
     * @param  string|null  $selected
     * @return void
     */
    public function __construct($ref, $selected = null)
    {
        $this->ref = $ref;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Load the citizenship reference data
        $citizenships = RefDataHelper::loadRefFile($this->ref);

        return view('components.reference.citizenship', compact('citizenships'));
    }
}
