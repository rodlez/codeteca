<div class="bg-white shadow rounded-xl mx-4">

    <!-- Header -->
    <div class="flex flex-row justify-between items-center py-4 bg-green-600 rounded-t-lg">
        <div>
            <i class="fa-lg sm:fa-2x fa-solid fa-laptop-code pl-4 text-white"></i>
            <span class="text-lg text-white px-4">Edit Entry </span>
        </div>
        <div class="px-4">
            <button wire:click.prevent="help">
                <i class="fa-lg fa-solid fa-circle-question text-white hover:text-black transition duration-1000 ease-in-out" title="help"></i>
            </button>
        </div>
    </div>

    <!-- Edit -->
    <form wire:submit="save">
        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
        @csrf
        <!-- Title -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Title <span class="text-red-400">*</span></h2>
            </div>
            <div class="flex flex-row justify-start items-center gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-pen-to-square"></i>
                </span>
                <input wire:model="title" name="title" id="title" type="text" value="{{ $entry->title }}" class="w-full pl-4 p-2 text-md rounded-lg bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
            </div>
        </div>
        <div class="py-2 px-20 sm:mx-12 text-red-600 font-semibold">
            @error('title')
                {{ $message }}
            @enderror
        </div>
        <!-- Type -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Type <span class="text-red-400">*</span></h2>
            </div>
            <div class="flex flex-row justify-start items-center gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-list"></i>
                </span>
                <select wire:model="type_id" name="type_id" id="type_id" class="w-full pl-4 p-2 text-md rounded-lg bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}"
                                @if (old('type_id') == $type->id) selected @endif>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="py-2 px-20 sm:mx-12 text-red-600 font-semibold">
            @error('type_id')
                {{ $message }}
            @enderror
        </div>
        <!-- Category -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Category <span class="text-red-400">*</span></h2>
            </div>
            <div class="flex flex-row justify-start items-center gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-list"></i>
                </span>
                <select wire:model="category_id" name="category_id" id="category_id" class="w-full pl-4 p-2 text-md rounded-lg bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                                @if (old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="py-2 px-20 sm:mx-12 text-red-600 font-semibold">
            @error('category_id')
                {{ $message }}
            @enderror
        </div>
        <!-- Help -->
        @if ($show % 2 != 0)
            <div class="text-white py-4 m-4 bg-zinc-400 rounded-lg">
                <p class="px-4">Keep Ctrl press + click to select multiple tags</p>
            </div>
        @endif
        <!-- Tags -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Tags <span class="text-red-400">*</span></h2>
            </div>
            <div class="flex flex-row justify-start items-start gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-tags"></i>
                </span>
                <select wire:model.live="selectedTags" name="selectedTags" id="selectedTags" multiple class="w-full pl-4 p-2 text-md rounded-lg bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" @foreach ($selectedTags as $selectedTag) @if ($tag->id == $selectedTag) selected class="bg-orange-500 text-white" @endif @endforeach>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="py-2 px-20 sm:mx-12 text-red-600 font-semibold">
            @error('selectedTags')
                {{ $message }}
            @enderror
        </div>
        <!-- Url -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="flex flex-row px-16">
                <h2 class="text-lg font-semibold py-2">Url
                    @if ($inputs->count() < 5)
                        <button type="button" wire:click="add()" class="align-middle mx-2 px-2">
                            <i class="fa-solid fa-circle-plus" title="Add Url"></i>
                        </button>
                    @else
                        <span class="text-red-400 text-xs px-4">You have reached the limit of Urls (5)</span>
                    @endif
                </h2>
            </div>
            @php $count = 0 @endphp
            @foreach ($inputs as $key => $value)
                <div class="flex flex-row justify-start items-center gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-globe"></i>
                    </span>
                    <input wire:model.live="inputs.{{ $key }}.url" id="inputs.{{ $key }}.url" type="text" class="w-2/3 pl-4 p-2 bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                    <button type="button" wire:click="remove({{ $key }})" class="align-middle mx-2 px-2">
                        <span style="font-size: 1.2rem; color: rgba(204, 13, 13, 0.849);"><i class="fa-solid fa-trash"></i></span>
                    </button>
                </div>
                <div class="py-2 px-20 sm:mx-12 text-sm text-red-600 font-semibold">
                    @error('inputs.' . $key . '.url')
                        {{ $message }}
                    @enderror
                </div>
                @php $count++ @endphp
            @endforeach
        </div>
        <!-- Info -->
        {{-- <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Info</h2>
            </div>
            <div class="flex flex-row justify-start items-start gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-circle-info"></i>
                </span>
                <textarea rows="8" cols="20" wire:model="info" name="info" id="info" type="text" class="appearance-none block w-full bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">{{ old('info') }}</textarea>
            </div>
        </div> --}}
        
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Info</h2>
            </div>
            <div class="flex flex-row justify-start items-start gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-circle-info"></i>
                </span>
                <div class="w-full">
                    @livewire('quilleditor.quill', ['value' => $info])
                </div>
            </div>
        </div>
        <!-- Errors -->
        <div class="py-2 px-20 sm:mx-12 text-red-600 font-semibold">
            @error('info')
                {{ $message }}
            @enderror
        </div>
        <!-- Code -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <h2 class="text-lg font-semibold py-2">Code</h2>
            </div>
            <div class="flex flex-row justify-start items-start gap-4">
                <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-laptop-code"></i>
                </span>
                <textarea rows="8" cols="20" wire:model="code" name="code" id="code" type="text" class="appearance-none block w-full bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">{{ old('code') }}</textarea>
            </div>
        </div>        
        <!-- Errors -->
        <div class="py-2 px-20 sm:mx-12 text-red-600 font-semibold">
            @error('code')
                {{ $message }}
            @enderror
        </div>
        
        <!-- Save -->
        <div class="py-0 px-4 sm:mx-12">
            <div class="px-16">
                <button type="submit" class="w-full sm:w-fit bg-black hover:bg-slate-700 text-white capitalize p-2 sm:px-4 rounded-lg shadow-none transition duration-500 ease-in-out">
                    Save
                    <i class="fa-solid fa-floppy-disk px-2"></i>
                </button>
            </div>
        </div>

    </form>

    <!-- Footer -->
    <div class="py-4 flex flex-row justify-end items-center px-4 bg-green-600 rounded-b-lg">
        <a href="{{ route('codeentry.show', $entry) }}">
            <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out" title="Go Back"></i>
        </a>
    </div>

</div>
