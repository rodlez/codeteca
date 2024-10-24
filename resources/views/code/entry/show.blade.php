<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500">
            <a href="/dashboard/entry" class="hover:text-green-600">Entries</a> /
            <a href="/dashboard/entry/{{ $entry->id }}"
                class="font-bold text-black border-b-2 border-b-green-600">Info</a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <!-- Header -->
            <div class="flex flex-row justify-between items-center py-4 bg-green-600">
                <span class="text-lg text-white px-4">Entry Info</span>
            </div>

            <!-- INFO -->
            <div class="mx-auto w-11/12 sm:w-4/5 mt-4 my-10 bg-gray-100 rounded-md shadow-lg">

                <div class="flex flex-row border-b-2 border-b-green-600">
                    <span class="text-xl text-green-600 font-bold w-full p-4">Entry Information</span>
                    <div class="flex flex-row justify-end items-center gap-4 w-fit">
                        <!-- Edit -->
                        <a href="{{ route('codeentry.edit', $entry) }}"
                            >
                            <i class="fa-solid fa-pencil text-blue-600 hover:text-blue-400 transition-all duration-500"></i>
                        </a>
                        <!-- Delete -->
                        <form action="{{ route('codeentry.destroy', $entry) }}" method="POST">
                            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                            @csrf
                            <!-- Dirtective to Override the http method -->
                            @method('DELETE')
                            <button
                                onclick="return confirm('Are you sure you want to delete the entry: {{ $entry->title }}?')">
                                <i class="fa-solid fa-trash pr-4 text-red-600 hover:text-red-400 transition-all duration-500"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Id -->
                <div class="flex flex-col sm:flex-row py-2 px-4 gap-1 border-b border-b-gray-200">
                    <div class="flex flex-row justify-start items-center gap-2">
                        <i class="fa-solid fa-fingerprint"></i>
                        <span class="sm:text-lg font-bold sm:w-24">Id</span>
                    </div>
                    <span class=" w-full px-6 sm:px-2">{{ $entry->id }}</span>
                </div>
                <!-- Title -->
                <div class="flex flex-col sm:flex-row py-2 px-4 gap-1 border-b border-b-gray-200">
                    <!-- Clipboard Title Button-->
                    <div class="flex flex-row justify-start items-center gap-2">
                        <span x-data="{ show: false }" class="relative" data-tooltip="Copy Title">
                            <button class="btn" data-clipboard-target="#title" x-on:click="show = true"
                                x-on:mouseout="show = false">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <span x-show="show" class="absolute -top-8 -right-6">
                                <span class="bg-green-600 text-white rounded-lg p-2 opacity-100">Copied!</span>
                            </span>
                        </span>
                        <span class="sm:text-lg font-bold sm:w-24">Title</span>
                    </div>
                    <div id="title" class=" w-full px-6 sm:px-2">{{ $entry->title }}</div>
                </div>
                <!-- Date -->
                <div class="flex flex-col sm:flex-row py-2 px-4 gap-1 border-b border-b-gray-200">
                    <div class="flex flex-row justify-start items-center gap-2">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span class="sm:text-lg font-bold sm:w-24">Date</span>
                    </div>
                    <span class=" w-full px-6 sm:px-2">{{ date_format($entry->created_at, 'd-m-Y') }}</span>
                </div>
                <!-- Type -->
                <div class="flex flex-col sm:flex-row py-2 px-4 gap-2 sm:gap-1 border-b border-b-gray-200">
                    <div class="flex flex-row justify-start items-center gap-2">
                        <i class="fa-solid fa-sitemap"></i>
                        <span class="sm:text-lg font-bold sm:w-24">Type</span>
                    </div>
                    <div class=" w-full px-6 sm:px-2">
                        <span class="bg-yellow-400 text-sm font-bold rounded-md p-2">{{ $entry->type->name }}</span>
                    </div>
                </div>
                <!-- Category -->
                <div class="flex flex-col sm:flex-row py-2 px-4 gap-2 sm:gap-1 border-b border-b-gray-200">
                    <div class="flex flex-row justify-start items-center gap-2">
                        <i class="fa-solid fa-list"></i>
                        <span class="sm:text-lg font-bold sm:w-24">Category</span>
                    </div>
                    <div class=" w-full px-6 sm:px-2">
                        <span class="bg-blue-400 text-sm font-bold rounded-md p-2">{{ $entry->category->name }}</span>
                    </div>
                </div>
                <!-- Tags -->
                <div class="flex flex-col sm:flex-row py-2 px-4 gap-2 sm:gap-1 border-b border-b-gray-200">
                    <div class="flex flex-row justify-start items-center gap-2">
                        <i class="fa-solid fa-tags"></i>
                        <span class="sm:text-lg font-bold sm:w-24">Tags</span>
                    </div>
                    <div class="flex flex-row flex-wrap  w-full px-6 sm:px-2 gap-2">
                        @foreach ($tags as $tag)
                            <span class="bg-orange-400 text-sm font-bold rounded-md p-2">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
                <!-- URL -->
                @if ($entry->url != null && $entry->url != '[]')
                    @foreach (json_decode($entry->url) as $key => $url)
                        <div class="flex flex-col sm:flex-row py-2 px-4 gap-1 border-b border-b-gray-200">
                            <div class="flex flex-row justify-start items-center gap-2">
                                <!-- Clipboard Url Button-->
                                <span x-data="{ show: false }" class="relative" data-tooltip="Copy Url">
                                    <button class="btn" data-clipboard-target="#url{{ $key }}"
                                        x-on:click="show = true" x-on:mouseout="show = false">
                                        <i class="fa-solid fa-globe"></i>
                                    </button>
                                    <span x-show="show" class="absolute -top-8 -right-6">
                                        <span class="bg-green-600 text-white rounded-lg p-2 opacity-100">Copied!</span>
                                    </span>
                                </span>

                                <span class="sm:text-lg font-bold sm:w-24">URL</span>
                            </div>
                            <div class="flex flex-row justify-start items-center w-full gap-2">
                                <div id="url{{ $key }}"
                                    class=" text-sm w-full overflow-hidden px-6 sm:px-2">{{ $url }}
                                </div>
                                <a href="{{ $url }}" target="_blank" title="Open Url">
                                    <i class="fa-solid fa-up-right-from-square px-3"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="flex flex-col sm:flex-row py-2 px-4 gap-1 border-b border-b-gray-200">
                        <div class="flex flex-row justify-start items-center gap-2">
                            <i class="fa-solid fa-globe"></i>
                            <span class="sm:text-lg font-bold sm:w-24">URL</span>
                        </div>
                        <div class=" w-full px-6 sm:px-2">-</div>
                    </div>
                @endif
                <!-- Info -->
                <div class="flex flex-col sm:flex-row py-2 px-4 gap-1 border-b border-b-gray-200">
                    <div class="flex flex-row justify-start items-center sm:items-start gap-2">
                        <i class="fa-solid fa-circle-info py-1"></i>
                        <span class="sm:text-lg font-bold sm:w-24">Info</span>
                    </div>
                    @if (strip_tags($entry->info) != '')
                        <div class="flex relative w-full">
                            <!-- Quill Editor -->
                            <div id="quill_editor"
                                class="w-full p-2 text-md rounded-lg bg-gray-200 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-orange-500 focus:border-orange-500 ">
                                {!! $entry->info !!}
                            </div>
                            <!-- Clipboard Info Button-->
                            <span x-data="{ show: false }" class="bg-white p-2 rounded-lg absolute top-2 right-2"
                                data-tooltip="Copy Info">
                                <button class="btn" data-clipboard-target="#quill_editor" x-on:click="show = true"
                                    x-on:mouseout="show = false">
                                    <i class="fa-regular fa-clipboard"></i>
                                </button>
                                <span x-show="show" class="absolute top-2 right-8">
                                    <span class="bg-green-600 text-white rounded-lg p-2 opacity-100">Copied!</span>
                                </span>
                            </span>
                        </div>
                    @else
                        <div class=" w-full px-6 sm:px-2">-</div>
                    @endif
                </div>
                <!-- Code -->
                <div class="flex flex-col sm:flex-row py-2 px-4 gap-1 border-b border-b-gray-200">
                    <div class="flex flex-row justify-start items-center sm:items-start gap-2">
                        <i class="fa-solid fa-laptop-code py-1"></i>
                        <span class="sm:text-lg font-bold sm:w-24">Code</span>
                    </div>
                    @if ($entry->code)
                        <div class="relative overflow-hidden w-full">
                            <!-- Highlightjs -->
                            <div class="w-full">
                                <pre><code id="code" value="{{ $entry->code }}" style="border-radius: 16px; padding: 15px 30px 30px 30px !important">{{ $entry->code }}</code></pre>
                            </div>
                            <!-- Clipboard Code Button-->
                            <span x-data="{ show: false }" class="bg-white p-2 rounded-lg absolute top-2 right-2"
                                data-tooltip="Copy Code">
                                <button class="btn" data-clipboard-target="#code" x-on:click="show = true"
                                    x-on:mouseout="show = false">
                                    <i class="fa-regular fa-clipboard"></i>
                                </button>
                                <span x-show="show" class="absolute top-2 right-8">
                                    <span class="bg-green-600 text-white rounded-lg p-2 opacity-100">Copied!</span>
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



                <!-- Files -->
                <div class="flex flex-col sm:flex-row py-2 px-4 gap-1">
                    <div class="flex flex-row justify-start items-center sm:items-start gap-2">
                        <i class="fa-solid fa-file py-1"></i>
                        <span class="sm:text-lg font-bold sm:w-24">Files ({{ $files->count() }})</span>
                    </div>

                    <!-- file Table -->
                    <div class="w-full overflow-x-auto">
                        @if ($files->count() !== 0)
                            <table class="table-auto w-full border text-sm">
                                <thead class="text-sm text-center text-white bg-green-600">
                                    <th></th>
                                    <th class="p-2 max-lg:hidden">Filename</th>
                                    <th class="p-2 max-sm:hidden">Created</th>
                                    <th class="p-2 max-sm:hidden">Size <span class="text-xs">(KB)</span></th>
                                    <th class="p-2">Format</th>
                                    <th></th>
                                </thead>

                                @foreach ($files as $file)
                                    <tr class="bg-white border-b text-center">

                                        @include('code.entry.partial-media-file', $file)

                                        <td class="p-2 max-lg:hidden">
                                            {{ shortFilename(getFileName($file->original_filename), 20) }}</td>
                                        <td class="p-2 max-sm:hidden">{{ $file->created_at->format('d-m-Y') }}
                                        </td>
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
                                <span class="text-red-400 font-semibold">Max files (5) reached. Delete some to
                                    upload a
                                    new File.</span>
                            @else
                                <!-- Upload file -->
                                <div class="flex flex-row">
                                    <a href="{{ route('codefile.index', $entry) }}"
                                        class="w-full sm:w-40 p-2 rounded-md text-white text-center bg-green-600 hover:bg-green-500 transition-all duration-500">
                                        <span> Upload File</span>
                                        <span class="px-2"><i class="fa-lg fa-solid fa-file-arrow-up"></i></span>
                                    </a>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>


            </div>


        </div>
        

        <!-- Footer -->
        <div class="py-4 flex flex-row justify-end items-center px-4 bg-green-600 sm:rounded-b-lg">
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
