@props(['title', 'messageBefore', 'messageAfter' => '', 'name' => '', 'confirmLabel', 'cancelLabel'])

<div x-data x-init="$refs.dialog.showModal()">
    <dialog
        x-ref="dialog"
        @close="$wire.close()"
        class="p-0 border-0 rounded-2xl shadow-[0px_5px_25px_0px_rgba(0,0,0,0.10)] w-80 m-auto backdrop:bg-blue-strong/50"
    >
        <div class="p-4 flex flex-col items-start gap-2.5">
            <div class="self-stretch flex flex-col items-center gap-8">
                <div class="self-stretch flex flex-col items-center gap-2">
                    <h2 class="self-stretch text-center font-serif font-bold text-2xl text-blue-strong">{{ $title }}</h2>

                    <p class="self-stretch text-center font-sans text-base text-gray-800">
                        {{ $messageBefore }}@if ($name)<span class="font-bold">{{ $name }}</span>{{ $messageAfter }}@endif
                    </p>
                </div>

                <div class="self-stretch flex justify-center items-center gap-6">
                    <button type="button" wire:click="close"
                            class="px-6 py-4 rounded-lg outline outline-1 outline-offset-[-1px] outline-red-strong font-sans font-medium text-base text-red-strong hover:bg-red-light transition duration-200 cursor-pointer">
                        {{ $cancelLabel }}
                    </button>
                    <button type="button" wire:click="confirm"
                            class="px-6 py-4 bg-red-strong rounded-lg outline outline-1 outline-offset-[-1px] outline-red-strong font-sans font-medium text-base text-white hover:bg-red-normal hover:outline-red-normal transition duration-200 cursor-pointer">
                        {{ $confirmLabel }}
                    </button>
                </div>
            </div>
        </div>
    </dialog>
</div>
