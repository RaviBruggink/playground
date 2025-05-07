<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePost extends Component
{
    #[\Livewire\Attributes\Validate]
    public $title = '';

    #[\Livewire\Attributes\Validate]
    public $email = '';

    public $submitted = false;

    protected function rules()
    {
        return [
            'title' => 'required|min:5',
            'email' => 'required|email',
        ];
    }

    public function submit()
    {
        $this->validate();
        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
