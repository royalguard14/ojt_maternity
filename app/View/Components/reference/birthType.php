<?php
namespace App\View\Components\Reference;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Helpers\RefDataHelper;

class BirthType extends Component
{
    public $ref;
    public $selected;


public function __construct($ref, $selected = null)
    {
        $this->ref = $ref;
        $this->selected = $selected;
    }

    public function render(): View|Closure|string
    {
        $birthTypes = RefDataHelper::loadRefFile($this->ref);
        return view('components.reference.birth-type', compact('birthTypes'));
    }
}
