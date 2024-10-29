<div>

    <!-- Header -->
    <div class="flex flex-row justify-between items-center py-4 bg-green-600">
            <span class="text-lg text-white px-4">New Entry</span>        
    </div>

    <!-- New Entry -->
    <form wire:submit="save">
        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
        @csrf

        <div class="mx-auto w-11/12">
            <!-- Title -->
            <h2 class="text-lg font-bold pt-2 pb-1 px-2">Title <span class="text-red-600">*</span></h2>

            <div class="relative">
                <input wire:model="title" name="title" id="title" type="text" value="{{ old('title') }}"
                    maxlength="255"
                    class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                    <i class="fa-solid fa-pen-to-square  bg-gray-200 p-3 rounded-l-md"></i>
                </div>
            </div>

            <div class="text-sm text-red-600 font-bold py-1 pl-12">
                @error('title')
                    {{ $message }}
                @enderror
            </div>
            <!-- Type -->
            <h2 class="text-lg font-bold pt-2 pb-1 px-2">Type <span class="text-red-600">*</span></h2>
            <div class="relative">
                <select wire:model="type_id" name="type_id" id="type_id"
                    class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" class="text-green-600"
                            @if (old('type_id') == $type->id) selected @endif>{{ $type->name }}</option>
                    @endforeach
                </select>
                <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                    <i class="fa-solid fa-sitemap bg-gray-200 p-3 rounded-l-md"></i>
                </div>
            </div>
            <div class="text-sm text-red-600 font-bold py-1 pl-12">
                @error('type_id')
                    {{ $message }}
                @enderror
            </div>
            <!-- Category -->
            <h2 class="text-lg font-bold pt-2 pb-1 px-2">Category <span class="text-red-600">*</span></h2>
            <div class="relative">
                <select wire:model="category_id" name="category_id" id="category_id"
                    class="w-full pl-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" class="text-green-600"
                            @if (old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="absolute flex items-center inset-y-0 left-0 pointer-events-none">
                    <i class="fa-solid fa-list bg-gray-200 p-3 rounded-l-md"></i>
                </div>
            </div>
            <div class="text-sm text-red-600 font-bold py-1 pl-12">
                @error('category_id')
                    {{ $message }}
                @enderror
            </div>
            <!-- Help -->
            @if ($show % 2 != 0)
                <div class="pt-4">
                    <div class="bg-gray-400 text-sm text-white w-fit p-2 rounded-lg relative">
                        <span>Use (Ctrl + Click) to select multiple tags.</span>
                        <button wire:click.prevent="help"><i
                                class="fa-solid fa-circle-xmark text-red-600 hover:text-red-400 transition duration-1000 ease-in-out absolute -top-2 -right-2"
                                title="Close"></i></button>
                    </div>
                </div>
            @endif
            <!-- Tags -->
            <div class="flex flex-row justify-between items-baseline">
                <h2 class="text-lg font-bold pt-2 pb-1 px-2">Tags <span class="text-red-600">*</span></h2>
                <button wire:click.prevent="help">
                    <i class="fa-solid fa-circle-question text-black hover:text-gray-600 transition duration-1000 ease-in-out"
                        title="help"></i>
                </button>
            </div>
            <div class="flex">
                <span><i class="bg-zinc-200 p-3 rounded-l-md fa-solid fa-tags"></i></span>
                <select wire:model.live="selectedTags" name="selectedTags" id="selectedTags" multiple
                    class="w-full px-1 rounded-tr-md rounded-br-md rounded-bl-md bg-gray-50 border border-gray-200 text-gray-900  dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" @if (old('selectedTags') == $tag->id) selected @endif>
                            {{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-sm text-red-600 font-bold py-1 pl-12">
                @error('selectedTags')
                    {{ $message }}
                @enderror
            </div>
            <!-- Url -->
            <div class="flex flex-row justify-start items-center gap-0">
                <h2 class="text-lg font-bold pt-2 pb-1 px-2">URLs</h2>
                @if ($inputs->count() < 5)
                    <button type="button" wire:click="add">
                        <i class="text-green-600 hover:text-green-400 transition duration-500 ease-in-out fa-solid fa-circle-plus"
                            title="Add Url"></i>
                    </button>
                @else
                    <span class="text-sm text-red-600 font-bold pt-1">You have reached the limit of Urls (5)</span>
                @endif
            </div>
            @php $count = 0 @endphp
            @foreach ($inputs as $key => $value)
                <div class="relative pb-2">
                    <input wire:model.live="inputs.{{ $key }}.url" id="inputs.{{ $key }}.url"
                        type="text" value="{{ old('url') }}" maxlength="2047"
                        class="w-full px-12 rounded-lg bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    @if ($count > 0)
                        <div class="absolute flex items-center inset-y-0 -top-2 right-0">
                            <button type="button" wire:click="remove({{ $key }})" title="Delete">
                                <i
                                    class="fa-solid fa-trash bg-gray-200 p-3 rounded-r-md text-red-600 hover:text-red-400 transition duration-500 ease-in-out "></i></span>
                            </button>
                        </div>
                    @endif
                    <div class="absolute flex items-center inset-y-0 -top-2 left-0 pointer-events-none">
                        <i class="fa-solid fa-globe bg-gray-200 p-3 rounded-l-md"></i>
                    </div>
                </div>
                <div class="text-sm text-red-600 font-bold px-14">
                    @error('inputs.' . $key . '.url')
                        {{ $message }}
                    @enderror
                </div>
                @php $count++ @endphp
            @endforeach
            <!-- Info -->
            <h2 class="text-lg font-bold pt-2 pb-1 px-2">Info</h2>            
            <div class="flex">
                <span><i class="bg-zinc-200 p-3 rounded-l-md fa-solid fa-circle-info"></i></span>
                <div class="w-full">
                    @livewire('quilleditor.quill')
                    {{-- <livewire:quilleditor.quill /> --}}
                </div>
            </div>
            <!-- Errors -->
            <div class="text-sm text-red-600 font-bold py-1 pl-12">
                @error('info')
                    {{ $message }}
                @enderror
            </div>
            <!-- Code -->
            <h2 class="text-lg font-bold pt-2 pb-1 px-2">Code</h2>            
            <div class="flex">
                <span><i class="bg-zinc-200 p-3 rounded-l-md fa-solid fa-laptop-code"></i></span>
                <textarea rows="8" cols="20" wire:model="code" name="code" id="code" type="text"
                    class=" w-full rounded-tr-md rounded-br-md rounded-bl-md bg-gray-50 border border-gray-200 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">{{ old('code') }}</textarea>
            </div>
            <!-- Errors -->
            <div class="text-sm text-red-600 font-bold px-14">
                @error('code')
                    {{ $message }}
                @enderror
            </div>
            <!-- Save -->
            <div class="py-4 sm:ml-11">
                <button type="submit"
                    class="w-full sm:w-60 bg-black hover:bg-slate-700 text-white uppercase p-2 rounded-md shadow-none transition duration-1000 ease-in-out">
                    Save
                    <i class="fa-solid fa-floppy-disk px-2"></i>
                </button>
            </div>

        </div>

    </form>

    <!-- Footer -->
    <div class="py-4 flex flex-row justify-end items-center px-4 bg-green-600 sm:rounded-b-lg">
        <a href="{{ route('codeentry.index') }}">
            <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                title="Go Back"></i>
        </a>
    </div>

</div>
