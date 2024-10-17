<div class="bg-white shadow rounded-xl mx-4">

    <!-- Header -->
    <div class="flex flex-row justify-between items-center py-4 bg-green-600 rounded-t-lg">
        <div>
            <i class="fa-lg sm:fa-2x fa-solid fa-laptop-code pl-4 text-white"></i>
            <span class="text-lg text-white px-4">New Type </span>
        </div>
        <div class="px-4">
            <button wire:click.prevent="help">
                <i class="fa-lg fa-solid fa-circle-question text-white hover:text-black transition duration-1000 ease-in-out" title="help"></i>
            </button>
        </div>
    </div>

    <!-- Help -->
    @if ($show % 2 != 0)
        <div class="mx-auto w-11/12 pt-4 pb-0">
            <div class="bg-zinc-100 text-black p-4 rounded-lg mx-2 border-double border-4 relative border-green-500">
                <p>Enter the name in the textbox.<br>To batch creation add more types using <i class="fa-solid fa-circle-plus text-green-600" title="Add new Type"></i> button.
                </p>
                <button wire:click.prevent="help"><i class="fa-solid fa-circle-xmark text-red-600 absolute top-2 right-2" title="Close"></i></button>
            </div>
        </div>
    @endif

    <!--Type -->
    <div class="mx-auto w-11/12 py-4 px-2">
        <div>
            <span class="text-lg font-semibold pl-4">Add</span>
            @if ($inputs->count() < 5)
                <button wire:click.prevent="add"><i class="fa-solid fa-circle-plus text-green-600 hover:text-green-500" title="Add new Type"></i></button>
            @else
                <span class="text-red-600 text-sm px-2">You have reached the limit (5)</span>
            @endif
        </div>
        @php $count = 0 @endphp
        @foreach ($inputs as $key => $value)
            <div class="flex flex-row justify-start items-center gap-2 py-2">

                <input wire:model="inputs.{{ $key }}.name" type="text" id="inputs.{{ $key }}.name" class="w-full sm:w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-green-500 focus:border-green-500 placeholder:text-zinc-400 pl-4" placeholder="Enter a Name">
                @if ($count > 0)
                    <button wire:click="remove({{ $key }})">
                        <i class="fa-solid fa-trash text-red-600 hover:text-red-400 px-2" title="Delete"></i>
                    </button>
                @else
                    <span class="px-4"></span>
                @endif
            </div>
            @error('inputs.' . $key . '.name')
                <div>
                    <span class="text-red-400 font-semibold px-4">{{ $message }}</span>
                </div>
            @enderror
            @php $count++ @endphp
        @endforeach
        <div class="py-4">
            <button wire:click.prevent="save" class="w-full sm:w-fit bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-lg shadow-none transition duration-500 ease-in-out" {{ $inputs->count() == 0 ? 'disabled' : '' }}>
                Save
                <i class="fa-solid fa-floppy-disk px-2"></i>
            </button>
        </div>
    </div>

    <!-- Footer -->
    <div class="py-4 flex flex-row justify-end items-center px-4 bg-green-600 rounded-b-lg">
        <a href="{{ route('codetype.index') }}">
            <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out" title="Go Back"></i>
        </a>
    </div>

</div>
