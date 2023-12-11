<?php

namespace App\View\Components\Forms;

use App\Models\IklanBanner;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class select extends Component
{
    /**
     * Create a new component instance.
     */

     public $id;
     public $name;
     public $label;
     public $options;
    public function __construct(
        $id, $name, $label, $options
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.select');
    }
}
