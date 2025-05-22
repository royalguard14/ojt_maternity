<?php
namespace App\View\Components\reference;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Helpers\RefDataHelper;

class Occupation extends Component
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
        $occupations = RefDataHelper::loadRefFile($this->ref);

        return view('components.reference.occupation', compact('occupations'));
    }
}
