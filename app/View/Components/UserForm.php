<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserForm extends Component
{
    public $user;
    public $action;
    public $method;
    public $disable;
    public $projects;
    public $departments;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user = null,Collection $projects,Collection $departments,$action,$method = 'POST',bool $disable = false)
    {
        $this->user = $user ?: new User();
        $this->projects = $projects;
        $this->departments = $departments;
        $this->action = $action;
        $this->method = $method;
        $this->disable = $disable;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('users.components.user-form');
    }
}
