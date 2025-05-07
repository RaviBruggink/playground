<div>
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">My To-Do List</h1>

        <!-- FORM -->
        <form wire:submit.prevent="addTodo" class="mb-4">
            <input type="text" wire:model="newTodo" placeholder="New task..."
                class="border p-2 w-full mb-2 rounded text-neutral-900" />
            <input type="time" wire:model="newTime"
                class="border p-2 w-full mb-2 rounded text-neutral-900" />
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded w-full transition-transform hover:scale-105">
                Add
            </button>
        </form>

        @php
            $sortedTodos = collect($todos)->sortBy('time')->values();
        @endphp

        <!-- AGENDA SLOTS -->
        <div class="relative border-l-2 border-gray-300 pl-4 space-y-2">
            @foreach ($sortedTodos as $index => $todo)
                @php
                    $startTime = \Carbon\Carbon::createFromFormat('H:i', $todo['time']);
                    $nextTime = isset($sortedTodos[$index + 1])
                        ? \Carbon\Carbon::createFromFormat('H:i', $sortedTodos[$index + 1]['time'])
                        : $startTime->copy()->addMinutes(60); // default 1 uur als laatste item

                    $duration = $startTime->diffInMinutes($nextTime);
                    $heightPerMinute = 1.5; // px per minuut
                    $blockHeight = max(30, $duration * $heightPerMinute);
                @endphp

                <div class="relative bg-blue-100 rounded-lg shadow px-4 py-2 flex flex-col justify-between"
                     style="height: {{ $blockHeight }}px;">
                    <div class="text-xs text-gray-600">
                        {{ $startTime->format('H:i') }} - {{ $nextTime->format('H:i') }}
                    </div>
                    <div class="flex justify-between items-end">
                        <span class="text-gray-900 font-medium">{{ $todo['text'] }}</span>
                        <div class="space-x-2 text-sm">
                            <button wire:click="editTodo({{ $index }})" class="text-blue-500 hover:underline">Edit</button>
                            <button wire:click="deleteTodo({{ $index }})" class="text-red-500 hover:underline">Delete</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <livewire:edit-todo wire:key="edit-todo" />
</div>