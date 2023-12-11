<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Monolog\Level;

class alert extends Component
{
    /**
     * @var string
     */
    public $level;

    /**
     * @var mixed
     */
    public $message;

    /**
     * @param string $level
     * @param mixed $message
     */
   
    public function __construct(string $level,$message)
    {
        $this->level =$level;
        $this->message =$message;
    }

    /**
     * Get the view / contents that represent the component.
     * @return View
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
