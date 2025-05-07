<?php

namespace App\Livewire;

use Livewire\Component;

class EditTodo extends Component
{
    public $show = false;
    public $value = '';
    public $time = '';
    public $index = null;

    protected $listeners = ['open-modal' => 'open'];

    public function open($todo, $index)
    {
        $this->value = $todo['text'];
        $this->time = $todo['time'];
        $this->index = $index;
        $this->show = true;
    }

    public function save()
    {
        // Dispatch event to parent (TodoList)
        $this->dispatch('todo-updated', index: $this->index, value: [
            'text' => $this->value,
            'time' => $this->time,
        ]);

        $this->reset(['show', 'value', 'time', 'index']);
    }

    public function render()
    {
        return view('livewire.edit-todo');
    }
}