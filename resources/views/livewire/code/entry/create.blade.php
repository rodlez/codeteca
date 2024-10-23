<div>

    <!-- Header -->
    <div class="flex flex-row justify-between items-center py-4 bg-green-600">
        <div>
            <span class="text-lg text-white px-4">New Entry </span>
        </div>
        <div class="px-4">
            <button wire:click.prevent="help">
                <i class="fa-lg fa-solid fa-circle-question text-white hover:text-black transition duration-1000 ease-in-out"
                    title="help"></i>
            </button>
        </div>
    </div>

    <!-- New Entry -->
    <form wire:submit="save">
        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
        @csrf

        <div class="mx-auto w-11/12">
            <!-- Title -->
            <h2 class="text-lg font-bold pt-4 pb-1 px-14">Title <span class="text-red-400">*</span></h2>
            <div class="flex gap-2">
                <i class="bg-zinc-200 p-3 rounded-lg fa-solid fa-pen-to-square"></i>
                <input wire:model="title" name="title" id="title" type="text" value="{{ old('title') }}"
                    class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
            </div>
            <div class="text-sm text-red-600 font-bold px-14">
                @error('title')
                    {{ $message }}
                @enderror
            </div>
            <!-- Type -->
            <h2 class="text-lg font-bold pt-4 pb-1 px-14">Type <span class="text-red-400">*</span></h2>
            <div class="flex gap-2">
                <i class="bg-zinc-200 p-3 rounded-lg fa-solid fa-sitemap"></i>
                <select wire:model="type_id" name="type_id" id="type_id"
                    class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" class="text-green-600"
                            @if (old('type_id') == $type->id) selected @endif>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-sm text-red-600 font-bold px-14">
                @error('type_id')
                    {{ $message }}
                @enderror
            </div>
            <!-- Category -->
            <h2 class="text-lg font-bold pt-4 pb-1 px-14">Category <span class="text-red-400">*</span></h2>
            <div class="flex gap-2">
                <i class="bg-zinc-200 p-3 rounded-lg fa-solid fa-list"></i>
                <select wire:model="category_id" name="category_id" id="category_id"
                    class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" class="text-green-600"
                            @if (old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-sm text-red-600 font-bold px-14">
                @error('category_id')
                    {{ $message }}
                @enderror
            </div>
            <!-- Help -->
            @if ($show % 2 != 0)
                <div class="pt-4">
                    <div class="bg-black text-sm text-white w-fit p-2 mx-12 rounded-lg relative">
                        <span class="text-yellow-400 font-bold">HELP - </span> (Ctrl + Click) to select multiple tags.
                        <button wire:click.prevent="help"><i
                                class="fa-lg fa-solid fa-circle-xmark text-red-600 hover:text-red-400 transition duration-1000 ease-in-out absolute top-0 -right-3"
                                title="Close"></i></button>
                    </div>
                </div>
            @endif
            <!-- Tags -->
            <h2 class="text-lg font-bold pt-4 pb-1 px-14">Tags <span class="text-red-400">*</span></h2>
            <div class="flex gap-2">
                <span><i class="bg-zinc-200 p-3 rounded-lg fa-solid fa-tags"></i></span>
                <select wire:model.live="selectedTags" name="selectedTags" id="selectedTags" multiple
                    class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900  dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" @if (old('selectedTags') == $tag->id) selected @endif>
                            {{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-sm text-red-600 font-bold px-14">
                @error('selectedTags')
                    {{ $message }}
                @enderror
            </div>
            <!-- Url -->
            <div class="flex flex-row justify-start items-center pt-4 px-14 gap-2">
                <h2 class="text-lg font-bold">URLs</h2>
                @if ($inputs->count() < 5)
                    <button type="button" wire:click="add">
                        <i class="text-green-600 hover:text-green-400 transition duration-500 ease-in-out fa-solid fa-circle-plus"
                            title="Add Url"></i>
                    </button>
                @else
                    <span class="text-sm text-red-600 font-bold">You have reached the limit of Urls (5)</span>
                @endif
            </div>
            @php $count = 0 @endphp
            @foreach ($inputs as $key => $value)
                <div class="flex flex-row justify-start items-center pt-2 gap-2">
                    <i class="bg-zinc-200 p-3 rounded-lg fa-solid fa-globe"></i>
                    <input wire:model.live="inputs.{{ $key }}.url" id="inputs.{{ $key }}.url"
                        type="text" value="{{ old('url') }}"
                        class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">
                    @if ($count > 0)
                        <button type="button" wire:click="remove({{ $key }})" title="Delete">
                            <i
                                class="text-red-600 hover:text-red-400 transition duration-500 ease-in-out fa-solid fa-trash"></i></span>
                        </button>
                    @endif
                </div>
                <div class="text-sm text-red-600 font-bold px-14">
                    @error('inputs.' . $key . '.url')
                        {{ $message }}
                    @enderror
                </div>
                @php $count++ @endphp
            @endforeach
            <!-- Info -->
            <h2 class="text-lg font-bold pt-4 pb-1 px-14">Info</h2>
            <div class="flex gap-2">
                <span><i class="bg-zinc-200 p-3 rounded-lg fa-solid fa-circle-info"></i></span>
                <div class="w-full rounded-lg bg-zinc-100">
                    @livewire('quilleditor.quill')
                    {{-- <livewire:quilleditor.quill /> --}}
                </div>
            </div>
            <!-- Errors -->
            <div class="text-sm text-red-600 font-bold px-14">
                @error('info')
                    {{ $message }}
                @enderror
            </div>
            <!-- Code -->
            <h2 class="text-lg font-bold pt-4 pb-1 px-14">Code</h2>
            <div class="flex gap-2">
                <span><i class="bg-zinc-200 p-3 rounded-lg fa-solid fa-laptop-code"></i></span>
                <textarea rows="8" cols="20" wire:model="code" name="code" id="code" type="text"
                    class=" w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-green-500 focus:border-green-500">{{ old('code') }}</textarea>
            </div>
            <!-- Errors -->
            <div class="text-sm text-red-600 font-bold px-14">
                @error('code')
                    {{ $message }}
                @enderror
            </div>
            <!-- Save -->
                <div class="py-6 sm:ml-12">
                    <button type="submit"
                        class="w-full sm:w-60 bg-black hover:bg-slate-700 text-white uppercase p-2 rounded-lg shadow-none transition duration-1000 ease-in-out">
                        Save
                        <i class="fa-solid fa-floppy-disk px-2"></i>
                    </button>
                </div>


        </div>




    </form>

    <!-- Footer -->
    <div class="py-4 flex flex-row justify-end items-center px-4 bg-green-600 rounded-b-lg">
        <a href="{{ route('codeentry.index') }}">
            <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                title="Go Back"></i>
        </a>
    </div>

</div>
