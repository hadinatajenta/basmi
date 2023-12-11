<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class input extends Component
{
    /**
     * Create a new component instance.
     */
    
    
    public $type;
    public $id;
    public $label;
    public $placeholder;
    public $name;
    public $isRequired;
    public $value;
    
    public function __construct(
      $type ='text',
      $id,
      $placeholder = null,
      $name,
      $label,
      $isRequired =false,
      $value = ''
    )

    {
        $this->type = $type;
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->label = $label;
        $this->isRequired = $isRequired;
        $this->value =$value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input',[
            'type' => $this->type,
            'id' => $this->id,
            'placeholder' => $this->placeholder,
            'name' => $this->name,
            'label' => $this->label,
            'isRequired' => $this->isRequired,
            'value' => $this->value,
        ]);
    }
}
