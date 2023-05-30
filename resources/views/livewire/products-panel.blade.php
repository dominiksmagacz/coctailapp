<div>
    <div class="relative mr-4 mt-4 mb-3 text-right text-sm font-medium sm:pr-6">
        <a href="{{ route('shops.edit', '$id') }}"
            class="text-indigo-600 hover:text-indigo-900">Edytuj</a>
    </div>
    <div class="relative whitespace-nowrap  text-right text-sm font-medium sm:pr-6">
        <a href="#" class="mt-4 px-6 py-1 text-red-800" wire:click.prevent="removeProduct('$id')">Usuń</a>
    </div>
</div>
