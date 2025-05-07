<div>
    @if ($show)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded w-full max-w-md">
                <h2 class="text-lg font-semibold mb-4 text-neutral-900">Edit Task</h2>

                <form wire:submit.prevent="save">
                    <input type="text" wire:model="value" class="border p-2 w-full mb-2 text-neutral-900"
                        placeholder="Task" />

                    <input type="time" wire:model="time" class="border p-2 w-full mb-4 text-neutral-900" />

                    <div class="flex justify-end space-x-2">
                        <button type="button" wire:click="$set('show', false)" class="text-gray-500">
                            Cancel
                        </button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>