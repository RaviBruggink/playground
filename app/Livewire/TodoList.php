<?php
namespace App\Livewire;

use Livewire\Component;

class TodoList extends Component
{
    public $todos = [];
    public $newTodo = '';
    public $newTime = '';

    public $editingIndex = null;

    protected $listeners = ['todo-updated' => 'updateTodo'];

    public function addTodo()
    {
        if (trim($this->newTodo) === '' || trim($this->newTime) === '')
            return;

        $this->todos[] = [
            'text' => $this->newTodo,
            'time' => $this->newTime,
        ];

        $this->newTodo = '';
        $this->newTime = '';
    }


    public function deleteTodo($index)
    {
        unset($this->todos[$index]);
        $this->todos = array_values($this->todos);
    }

    public function editTodo($index)
    {
        $this->editingIndex = $index;
        $this->dispatch('open-modal', todo: $this->todos[$index], index: $index);
    }

    public function updateTodo($index, $value)
    {
        $this->todos[$index] = $value;
    }


    public function render()
    {
        return view('livewire.todo-list');
    }
}