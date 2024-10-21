<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <div class="container max-w-6xl mx-auto px-6 py-4">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-center py-2 px-2 text-slate-400">
            <a href="/dashboard" class="px-2 hover:text-green-600">Dashboard </a> /
            <a href="/dashboard/code" class="px-2 hover:text-green-600">Code</a> /
            <a href="/dashboard/code/entry" class="px-2 hover:text-green-600">Entries</a> /
            <a href="/dashboard/code/entry/{{ $entry->id }}"
                class="px-2 font-bold text-black border-b-2 border-b-green-500">Info</a>
        </div>

        <div class="bg-white shadow rounded-xl mx-4">
            <!-- Header -->
            <div class="flex flex-row justify-between items-center py-4 bg-green-600 rounded-t-lg">
                <div>
                    <i class="fa-lg sm:fa-2x fa-solid fa-laptop-code pl-4 text-white"></i>
                    <span class="text-lg text-white px-4">Entry Info</span>
                </div>
            </div>

            <!-- INFO -->
            <!-- Id -->
            <div class="pt-6 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Id</h2>
                </div>
                <div class="flex flex-row justify-start items-center gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-fingerprint"></i>
                    </span>
                    <div
                        class="w-32 p-2 text-md rounded-lg bg-gray-200 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                        {{ $entry->id }}
                    </div>
                </div>
            </div>
            <!-- Title -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Title</h2>
                </div>
                <div class="flex flex-row justify-start items-center gap-4">
                    <span x-data="{ show: false }" class="bg-zinc-200 px-3 py-2 rounded-lg relative"
                        data-tooltip="Copy Title">
                        <button class="btn" data-clipboard-target="#title" x-on:click="show = true"
                            x-on:mouseout="show = false">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <span x-show="show" class="absolute -top-2 right-0">
                            <i class="text-green-600 fa-regular fa-circle-check"></i>
                        </span>
                    </span>
                    <div id="title" value="{{ $entry->title }}"
                        class="w-full p-2 text-md rounded-lg bg-gray-200 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                        {{ $entry->title }}</div>
                </div>
            </div>
            <!-- Date -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Date</h2>
                </div>
                <div class="flex flex-row justify-start items-center gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-calendar-days"></i>
                    </span>
                    <div
                        class="w-full sm:w-1/3 p-2 text-md rounded-lg bg-gray-200 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 ">
                        {{ date_format($entry->created_at, 'd-m-Y') }}
                    </div>
                </div>
            </div>
            <!-- Type -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Type</h2>
                </div>
                <div class="flex flex-row justify-start items-center gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-sitemap"></i>
                    </span>
                    <span
                        class="inline-flex items-center rounded-md bg-red-50 p-2 text-sm font-medium text-red-700 ring-1 ring-inset ring-red-600/10">{{ $entry->type->name }}</span>
                </div>
            </div>
            <!-- Category -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Category</h2>
                </div>
                <div class="flex flex-row justify-start items-center gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-list"></i>
                    </span>
                    <span
                        class="inline-flex items-center rounded-md bg-green-50 p-2 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{ $entry->category->name }}</span>
                </div>
            </div>
            <!-- Tags -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Tags</h2>
                </div>
                <div class="flex flex-row justify-start items-center gap-4 ">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-tags"></i>
                    </span>
                    <div>
                        @foreach ($tags as $tag)
                            <span
                                class="inline-flex items-center rounded-md bg-yellow-50 m-1 p-2 text-sm font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">{{ $tag }}</span>
                        @endforeach
                    </div>

                </div>
            </div>
            <!-- Url -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Url</h2>
                </div>
                @if ($entry->url != null && $entry->url != '[]')
                    @foreach (json_decode($entry->url) as $key => $url)
                        <div class="flex flex-row justify-start items-center gap-4 py-2">

                            <span x-data="{ show: false }" class="bg-zinc-200 px-3 py-2 rounded-lg relative"
                                data-tooltip="Copy Url">
                                <button class="btn" data-clipboard-target="#url{{ $key }}"
                                    x-on:click="show = true" x-on:mouseout="show = false">
                                    <i class="fa-solid fa-globe"></i>
                                </button>
                                <span x-show="show" class="absolute -top-2 right-0">
                                    <i class="text-green-600 fa-regular fa-circle-check"></i>
                                </span>
                            </span>
                            <div id="url{{ $key }}"
                                class="w-full p-2 text-md rounded-lg bg-gray-200 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                                {{ $url }}
                            </div>
                            <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                                <a href="{{ $url }}" target="_blank" data-tooltip="Open Url"><i
                                        class="fa-solid fa-up-right-from-square"></i></a>
                            </span>
                        </div>
                    @endforeach
                @else
                    <div class="flex flex-row justify-start items-center gap-4 py-2">
                        <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                            <i class="fa-solid fa-globe"></i>
                        </span>
                        <div
                            class="w-full p-2 text-md rounded-lg bg-gray-200 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500">
                            -
                        </div>
                    </div>
                @endif
            </div>
            <!-- Info -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Info</h2>
                </div>
                <div class="flex flex-row justify-start items-start gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-circle-info"></i>
                    </span>
                    @if (strip_tags($entry->info) != '')
                        <div class="flex relative w-full">
                            <div id="quill_editor"
                                class="w-full p-2 text-md rounded-lg bg-gray-200 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 ">
                                {!! $entry->info !!}
                            </div>

                            <span x-data="{ show: false }"
                                class="bg-zinc-300 p-2 rounded-lg absolute top-2 right-2 opacity-80 hover:opacity-100"
                                data-tooltip="Copy Info">
                                <button class="btn" data-clipboard-target="#quill_editor" x-on:click="show = true"
                                    x-on:mouseout="show = false">
                                    <i class="fa-regular fa-clipboard"></i>
                                </button>
                                <span x-show="show" class="absolute -top-2 -right-2">
                                    <i class="text-green-600 fa-regular fa-circle-check"></i>
                                </span>
                            </span>
                        </div>
                    @else
                        <div
                            class="w-full p-2 text-md rounded-lg bg-gray-200 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 ">
                            -
                        </div>
                    @endif

                </div>
            </div>
            <!-- Code -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Code</h2>
                </div>
                <div class="flex flex-row justify-start items-start gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-laptop-code"></i>
                    </span>
                    @if ($entry->code)
                    <div class="flex relative w-4/5 sm:w-full">
                        
                         <div class="w-full">
                            <pre><code id="code" value="{{ $entry->code }}" style="border-radius: 16px; padding: 15px 30px 30px 30px !important">{{ $entry->code }}</code></pre>
                        </div>

                        <span x-data="{ show: false }" class="bg-white p-2 rounded-lg absolute top-2 right-2"
                            data-tooltip="Copy Code">
                            <button class="btn" data-clipboard-target="#code" x-on:click="show = true"
                                x-on:mouseout="show = false">
                                <i class="fa-regular fa-clipboard"></i>
                            </button>
                            <span x-show="show" class="absolute -top-8 right-0">
                                <span class="bg-yellow-400 text-black rounded-lg p-2 opacity-100">Copied</span>
                            </span>
                        </span>
                        
                    </div>
                        {{-- <div class="flex relative w-full">
                            <div class="w-full bg-red-400">
                                <pre><code id="code" value="{{ $entry->code }}" style="border-radius: 16px; padding: 15px 30px 30px 30px !important">{{ $entry->code === null ? '-' : $entry->code }}</code></pre>
                            </div>

                            <span x-data="{ show: false }" class="bg-white p-2 rounded-lg absolute top-2 right-2"
                                data-tooltip="Copy Code">
                                <button class="btn" data-clipboard-target="#code" x-on:click="show = true"
                                    x-on:mouseout="show = false">
                                    <i class="fa-regular fa-clipboard"></i>
                                </button>
                                <span x-show="show" class="absolute -top-8 right-0">
                                    <span class="bg-yellow-400 text-black rounded-lg p-2 opacity-100">Copied</span>
                                </span>
                            </span>
                        </div> --}}
                    @else
                        <div
                            class="w-full p-2 text-md rounded-lg bg-gray-200 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 ">
                            -
                        </div>
                    @endif

                </div>
            </div>
            <!-- Files -->
            <div class="py-2 px-4 sm:mx-12">
                <div class="px-16">
                    <h2 class="text-lg font-semibold py-2">Files ({{ $files->count() }})</h2>
                </div>
                <div class="flex flex-row justify-start items-start gap-4">
                    <span class="bg-zinc-200 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-file"></i>
                    </span>
                    <!-- file Table -->
                    <div class="w-full overflow-x-auto">
                        @if ($files->count() !== 0)
                            <table class="table-auto w-full border-2 mb-4 text-sm">
                                <thead class="text-sm text-center text-black bg-gray-200">
                                    <th></th>
                                    <th class="p-2 max-lg:hidden">Filename</th>
                                    <th class="p-2 max-sm:hidden">Created</th>
                                    <th class="p-2 max-sm:hidden">Size <span class="text-xs">(KB)</span></th>
                                    <th class="p-2">Format</th>
                                    <th></th>
                                </thead>

                                @foreach ($files as $file)
                                    <tr class="bg-white border-b-2 text-center">

                                        @switch($file->media_type)
                                            @case('application/vnd.ms-excel')
                                                <td class="py-2"><i class="fa-2x fa-regular fa-file-excel"></i></td>
                                            @break

                                            @case('text/csv')
                                                <td class="py-2"><i class="fa-2x fa-solid fa-file-csv"></i></td>
                                            @break

                                            @case('text/plain')
                                                <td class="py-2"><i class="fa-2x fa-regular fa-file-lines"></i></td>
                                            @break

                                            @case('application/javascript')
                                                <td class="py-2"><i class="fa-2x fa-brands fa-js"></i></td>
                                            @break

                                            @case('application/pdf')
                                                <td class="py-2"><i class="fa-2x fa-regular fa-file-pdf"></i></td>
                                            @break

                                            @case('text/html')
                                                <td class="py-2"><i class="fa-2x fa-brands fa-html5"></i></td>
                                            @break

                                            @case('text/x-php')
                                                <td class="py-2"><i class="fa-2x fa-brands fa-php"></i></td>
                                            @break

                                            @case('application/vnd.oasis.opendocument.text')
                                                <td class="py-2"><i class="fa-2x fa-regular fa-file-word"></i></td>
                                            @break

                                            @case('application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                <td class="py-2"><i class="fa-2x fa-regular fa-file-word"></i></td>
                                            @break

                                            @case('image/jpeg')
                                                <td class="py-2">
                                                    <a href="{{ asset('storage/' . $file->path) }}">
                                                        <img src="{{ asset('storage/' . $file->path) }}"
                                                            class="w-12 md:w-24 mx-auto rounded-lg"
                                                            title="{{ $file->original_filename }}">
                                                    </a>
                                                </td>
                                            @break

                                            @case('image/png')
                                                <td class="py-2">
                                                    <a href="{{ asset('storage/' . $file->path) }}">
                                                        <img src="{{ asset('storage/' . $file->path) }}"
                                                            class="w-12 md:w-24 mx-auto rounded-lg"
                                                            title="{{ $file->original_filename }}">
                                                    </a>
                                                </td>
                                            @break

                                            @default
                                                <td class="py-2"><i
                                                        class="fa-2x fa-solid fa-triangle-exclamation text-red-600 hover:text-red-400"
                                                        title="Not a valid Format"></i></td>
                                        @endswitch
                                        
                                        <td class="p-2 max-lg:hidden">
                                            {{ shortFilename(getFileName($file->original_filename), 20) }}</td>
                                        <td class="p-2 max-sm:hidden">{{ $file->created_at->format('d-m-Y') }}</td>
                                        <td class="p-2 max-sm:hidden">{{ round($file->size / 1000) }} </td>
                                        <td class="p-2 ">{{ basename($file->media_type) }}</td>
                                        <td class="p-2">
                                            <div class="flex justify-center items-center gap-2">
                                                <!-- Download file -->
                                                <a href="{{ route('codefile.download', [$entry, $file]) }}"
                                                    title="Download File">
                                                    <span
                                                        class="text-green-600 hover:text-black transition-all duration-500">
                                                        <i class="fa-lg fa-solid fa-file-arrow-down"></i>
                                                    </span>
                                                </a>
                                                <!-- Delete file -->
                                                <form action="{{ route('codefile.destroy', [$entry, $file]) }}"
                                                    method="POST">
                                                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                                                    @csrf
                                                    <!-- Dirtective to Override the http method -->
                                                    @method('DELETE')
                                                    <button
                                                        onclick="return confirm('Are you sure you want to delete the file: {{ $file->original_filename }}?')"
                                                        title="Delete file">
                                                        <span
                                                            class="text-red-600 hover:text-black transition-all duration-500"><i
                                                                class="fa-lg fa-solid fa-trash"></i></span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                            </table>
                        @endif
                        <div class="py-2">
                            @if ($files->count() >= 5)
                                <span class="text-red-400 font-semibold">Max files (5) reached. Delete some to upload a
                                    new File.</span>
                            @else
                                <!-- Upload file -->
                                <a href="{{ route('codefile.index', $entry) }}"
                                    class="w-full text-white text-center bg-green-600 hover:bg-green-500 focus:ring-4 focus:ring-violet-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    <span> Upload File</span>
                                    <span class="px-2"><i class="fa-lg fa-solid fa-file-arrow-up"></i></span>
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col justify-start sm:flex-row sm:justify-between p-4 gap-4 border-t-2 mt-8">
                <!-- Edit -->
                <a href="{{ route('codeentry.edit', $entry) }}"
                    class="w-full sm:w-1/3 bg-black hover:bg-slate-600 text-white text-center font-bold py-2 px-4 rounded-md">
                    <span>Edit</span>
                    <i class="fa-solid fa-pencil px-2"></i>
                </a>
                <!-- Delete -->
                <form action="{{ route('codeentry.destroy', $entry) }}" method="POST"
                    class="w-full sm:w-1/3 bg-red-600 hover:bg-red-500 text-white text-center font-bold py-2 px-4 rounded-md">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf
                    <!-- Dirtective to Override the http method -->
                    @method('DELETE')
                    <button
                        onclick="return confirm('Are you sure you want to delete the entry: {{ $entry->title }}?')">
                        <span>Delete</span>
                        <i class="fa-solid fa-trash px-2"></i>
                    </button>
                </form>

            </div>

            <!-- Footer -->
            <div class="py-4 flex flex-row justify-end items-center px-4 bg-green-600 rounded-b-lg">
                <a href="{{ route('codeentry.index') }}">
                    <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out"
                        title="Go Back"></i>
                </a>
            </div>

        </div>

    </div>

    <script>
        hljs.highlightAll();
        new ClipboardJS('.btn');
    </script>

</x-app-layout>
