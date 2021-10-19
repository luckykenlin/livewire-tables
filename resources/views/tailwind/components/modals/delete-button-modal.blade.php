@props([
'itemKey' => null,
])

<div
    x-data="{ showModal: @entangle($attributes->wire('model')).defer }"
>
    <div
        class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-gray-500 bg-opacity-75"
        x-show="showModal"
        x-transition:enter="transform duration-200"
        x-transition:enter-start="opacity-0 scale-100"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transform duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-100"
        x-cloak
    >
        {{-- Modal inner --}}
        <div
            class="w-auto px-6 py-4 mx-auto"
            @click.away="showModal = false"
            x-init="$watch('showModal', value => {
                    if (value) {
                        document.body.classList.add('overflow-y-hidden');
                    } else {
                        document.body.classList.remove('overflow-y-hidden');
                    }
                })"
        >
            <div class="relative rounded-xl border border-gray-200 shadow-lg bg-gray-50 p-4">

                {{-- Title --}}
                <div class="flex mt-6 mb-6 px-4">

                    {{-- Heroicon name: solid/check-circle --}}
                    <svg class="h-8 w-8 text-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                              clip-rule="evenodd"/>
                    </svg>

                    {{-- Title message --}}
                    <div class="ml-3">
                        <h1 class="text-xl font-medium text-gray-700">
                            @lang('livewire-tables::strings.delete.title')
                        </h1>
                    </div>
                </div>

                <div class="p-6 text-md bg-red-50 text-red-600 border-t border-b border-red-200">
                    @lang('livewire-tables::strings.delete.message')
                </div>

                <div class="pt-6 text-right">
                    <button
                        type="button"
                        @click="showModal = false"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                        @lang('livewire-tables::strings.delete.cancel')
                    </button>

                    <button
                        type="button"
                        class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition ml-2"
                        @click="showModal = false"
                        wire:click="delete({{$itemKey}})"
                    >
                        @lang('livewire-tables::strings.delete.delete')
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
