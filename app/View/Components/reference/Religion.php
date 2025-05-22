<?php

namespace App\View\Components\Reference;

use Illuminate\View\Component;
use App\Helpers\RefDataHelper;

class Religion extends Component
{
    public $ref;
    public $selected;

    public function __construct($ref, $selected = null)
    {
        $this->ref = $ref;
        $this->selected = $selected;
    }

    public function render()
    {
        // Load the religion data from the reference file
        $religions = RefDataHelper::loadRefFile($this->ref);
        return view('components.reference.religion', compact('religions'));
    }
}
