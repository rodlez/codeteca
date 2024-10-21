<div>

    <!-- Header -->
    <div class="flex flex-row justify-between items-center py-4 bg-green-400">
        <div>
            <span class="text-lg text-white px-4">Entries <span class="text-md">({{ $search != '' ? $found : $total }})</span></span>
        </div>
        <div class="px-4">
            <a href="{{ route('codeentry.create') }}" class="text-white text-sm sm:text-md rounded-lg py-2 px-4 bg-black hover:bg-slate-600 transition duration-1000 ease-in-out" title="Create New Entry">New</a>
        </div>
    </div>

    <!-- Filters -->
    <div class="flex flex-row justify-between items-center py-2 mx-4 mt-2 border-green-400 border-b-2 w-100 sm:w-100">
        <div>
            <i class="fa-lg fa-solid fa-filter text-green-400 pl-4"></i>
            <span class="px-2 text-lg text-zinc-800">Filters
                <span class="text-xs md:text-md font-semibold">
                    <span class="text-yellow-600">{{ $tipo > 0 ? '(Type)' : '' }}</span>
                    <span class="text-blue-600">{{ $cat > 0 ? '(Category)' : '' }}</span>
                    <span class="text-orange-600">{{ !in_array('0', $this->selectedTags) && count($this->selectedTags) > 0 ? '(Tags)' : '' }}</span>
                </span>
                {{-- <span class="text-sm font-semibold text-orange-400">
                    {{ $tipo != 0 ? '(Type)' : '' }}
                    {{ $cat != 0 ? '(Category)' : '' }}
                    {{ !in_array('0', $this->selectedTags) && count($this->selectedTags) != 0 ? '(Tags)' : '' }}
                </span> --}}
            </span>
        </div>
        <div>
            @if ($showFilters % 2 != 0)
                <a wire:click="activateFilter" class="cursor-pointer tooltip">
                    <i class="fa-solid fa-minus"></i>
                    <span class="tooltiptext">Close Filters</span>
                </a>
            @else
                <a wire:click="activateFilter" class="cursor-pointer tooltip">
                    <i class="fa-solid fa-plus"></i>
                    <span class="tooltiptext">Open Filters</span>
                </a>
            @endif
        </div>
    </div>

    @if ($showFilters % 2 != 0)
        <div class="bg-zinc-300 mx-4 border-black border-2 rounded-lg py-2 my-2 w-100 text-black text-md">
            <!-- Type -->
            <div class="flex flex-col justify-start items-start sm:flex-row sm:justify-between sm:items-center gap-1 px-4 py-2 ">
                <div class="w-full px-2 md:w-40 md:mx-auto md:text-start ">
                    <span><i class="fa-lg fa-solid fa-sitemap"></i></span>
                    <span class="px-2">Type (<span class="font-semibold text-sm">{{ count($types) }}</span>)</span>
                </div>
                <div class="flex flex-row items-center w-full md:w-1/2 md:text-start">
                    <select wire:model.live="tipo"
                            class="rounded-lg w-full md:w-80">
                        <option value="0">All</option>
                        @foreach ($types as $type)
                            <option value="{{ $type['name'] }}">{{ $type['name'] }}</option>
                        @endforeach
                    </select>
                    @if ($tipo > 0)
                        <a wire:click.prevent="clearFilterTipo" title="Reset Filter" class="cursor-pointer">
                            <span class="text-red-600 hover:text-red-400 px-2"><i class="fa-solid fa-circle-xmark"></i></span>
                        </a>
                    @endif
                </div>
            </div>
            <!-- Category -->
            <div class="flex flex-col justify-start items-start sm:flex-row sm:justify-between sm:items-center gap-1 px-4 py-2 ">
                <div class="w-full px-2 md:w-40 md:mx-auto md:text-start ">
                    <span><i class="fa-lg fa-solid fa-list"></i></span>
                    <span class="px-2">Category (<span class="font-semibold text-sm">{{ count($categories) }}</span>)</span>
                </div>
                <div class="flex flex-row items-center w-full md:w-1/2 md:text-start">
                    <select wire:model.live="cat"
                            class="rounded-lg w-full md:w-80">
                        <option value="0">All</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category['name'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                    @if ($cat > 0)
                        <a wire:click.prevent="clearFilterCat" title="Reset Filter" class="cursor-pointer">
                            <span class="text-red-600 hover:text-red-400 px-2"><i class="fa-solid fa-circle-xmark"></i></span>
                        </a>
                    @endif
                </div>
            </div>
            <!-- Tags -->
            <div class="flex flex-col justify-start items-start sm:flex-row sm:justify-between sm:items-start gap-1 px-4 py-2">
                <div class="w-full px-2 md:w-40 md:mx-auto md:text-start ">
                    <span><i class="fa-lg fa-solid fa-tags"></i></span>
                    <span class="px-2">Tags (<span class="font-semibold text-sm">{{ count($tags) }}</span>)</span>
                </div>
                <div class="flex flex-row items-start w-full md:w-1/2 md:text-start">
                    <select wire:model.live="selectedTags" name="selectedTags" id="selectedTags" multiple
                            class="rounded-lg w-full md:w-80" size="6">
                        <option value="0">All</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag['id'] }}">{{ $tag['name'] }}</option>
                        @endforeach
                    </select>
                    @if ($selectedTags != [])
                        <a wire:click.prevent="clearFilterTag" title="Reset Filter" class="cursor-pointer">
                            <span class="text-red-600 hover:text-red-400 px-2"><i class="fa-solid fa-circle-xmark"></i></span>
                        </a>
                    @endif
                </div>
            </div>
            <!-- Reset Filters -->
            <div class="flex flex-row md:justify-end md:w-full px-4 pb-2 pt-0">
                <div class="w-full md:w-1/2">
                    <button type="button" class="w-full md:w-80 bg-black text-white p-2 hover:bg-slate-700 rounded-lg" wire:click="clearFilters">
                        <span> Reset Filters </span>
                        <span class="px-2"><i class="fa-solid fa-delete-left"></i></span>
                    </button>
                </div>
            </div>

        </div>
    @endif
    <!-- Search -->
    <div class="flex flex-col items-start sm:justify-between sm:flex-row px-4 py-4 w-100 gap-2">
        <!-- Search -->
        <div class="relative w-full">
            <div class="absolute top-2.5 bottom-0 left-4 text-slate-700">
                <i class="fa-lg fa-solid fa-magnifying-glass"></i>
            </div>
            <input type="search" class="w-full rounded-lg pl-12 placeholder-zinc-400 focus:outline-none focus:ring-0 focus:border-green-400 border-2 border-zinc-200 placeholder:text-sm" placeholder="Search by title" wire:model.live="search">
        </div>
        <!-- Pagination -->
        <div class="relative w-32">
            <div class="absolute top-2.5 bottom-0 left-4 text-slate-700">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <select wire:model.live="perPage" class="w-full rounded-lg text-end focus:outline-none focus:ring-0 focus:border-green-500 border-2 border-zinc-200 ">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>

    <!-- Criteria -->
    @if ($search != '' || $tipo > 0 || $cat > 0 || (!in_array('0', $this->selectedTags) && count($this->selectedTags) != 0))
        <div class="flex flex-row justify-between items-center rounded-lg mx-4 py-2 px-4 bg-zinc-100 border-2 border-zinc-300">
            <div>
                <p class="text-sm font-semibold">
                    <span class="text-lg text-black">Criteria > </span>
                    <span class="text-orange-400">{{ $search != '' ? 'Search' : '' }}</span>
                    <span class="text-yellow-600">{{ $tipo > 0 ? 'Type (' . $tipo . ')' : '' }}</span>
                    <span class="text-blue-600">{{ $cat > 0 ? 'Category (' . $cat . ')' : '' }}</span>
                    <span class="text-orange-600">{{ !in_array('0', $this->selectedTags) && count($this->selectedTags) != 0 ? 'Tags (' . implode(', ', $tagNames) . ')' : '' }}</span>
                </p>
            </div>
            <div>
                <span class="text-md text-red-600 font-semibold px-4">
                    <a wire:click.prevent="resetAll" data-tooltip="Reset">
                        <i class="fa-lg fa-solid fa-circle-xmark hover:text-red-400 cursor-pointer px-2"></i>
                    </a>
                </span>
            </div>

        </div>
    @endif

    <!-- Bulk Actions -->
    @if (count($selections) > 0)
        <div class="flex flex-row justify-start items-end sm:flex-row sm:justify-start gap-6 py-0 px-6">
            <span class="text-sm font-semibold">Entries Selected</span>
            <a wire:click.prevent="bulkClear" class="cursor-pointer" title="Unselect All">
                <span><i class="fa-solid fa-arrow-rotate-left text-green-400"></i></span>
            </a>
            <a wire:click.prevent="bulkDelete" wire:confirm="Are you sure you want to delete this entries?" class="cursor-pointer text-red-600" title="Delete">
                <span><i class="fa-solid fa-trash"></i></span>
                <span class="px-1">({{ count($selections) }})</span>
            </a>
        </div>
    @endif

    <!-- Table -->
    <div class="flex flex-col p-4">

        <div class="overflow-x-auto">

            @if ($entries->count())
                <table class="table-fixed min-w-full">
                    <thead class="h-12">
                        <tr class="text-black text-left text-sm uppercase">
                            {{-- <th class="p-2"><input wire:model.live="selectAll" type="checkbox" class="text-orange-400 outline-none focus:ring-0 checked:bg-green-500"></th> --}}
                            <th class="rounded-tl-lg"></th>
                            <th wire:click="sorting('id')" scope="col" class="p-2 hover:cursor-pointer hover:text-green-600 {{ $column == 'id' ? 'text-green-600' : '' }}">id {!! $sortLink !!}</th>
                            <th wire:click="sorting('title')" scope="col" class="p-2 hover:cursor-pointer  hover:text-green-600 {{ $column == 'title' ? 'text-green-600' : '' }}">title {!! $sortLink !!}</th>
                            <th wire:click="sorting('type_name')" scope="col" class="p-2 hover:cursor-pointer  hover:text-green-600 {{ $column == 'type_name' ? 'text-green-600' : '' }}">type <span class="text-xs">{{ '(' . $differentTypes . ')' }}</span> {!! $sortLink !!}</th>
                            <th wire:click="sorting('category_name')" scope="col" class="p-2 hover:cursor-pointer  hover:text-green-600 {{ $column == 'category_name' ? 'text-green-600' : '' }}">category <span class="text-xs">{{ '(' . $differentCategories . ')' }}</span> {!! $sortLink !!}</th>
                            <th wire:click="sorting('created')" scope="col" class="p-2 hover:cursor-pointer  hover:text-green-600 {{ $column == 'created' ? 'text-green-600' : '' }}">created {!! $sortLink !!}</th>
                            <th scope="col" class="p-2">Tags</th>
                            <th scope="col" class="p-2 text-center">Files</th>
                            <th scope="col" class="p-2 text-center rounded-tr-lg">actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($entries as $entry)
                        <tr class="even:bg-zinc-200 odd:bg-gray-300 transition-all duration-1000 hover:bg-yellow-400">
                            <td class="px-2"><input wire:model.live="selections" type="checkbox" class="text-green-400 outline-none focus:ring-0 checked:bg-green-500" value={{ $entry->id }}></td>
                                <td class="px-2">{{ $entry->id }}</td>
                                <td class="px-2 cursor-pointer" title="{{ $entry->title }}">
                                    <a href="{{ route('codeentry.show', $entry) }}" data-tooltip="See this entry">
                                        {{-- {{ excerpt($entry->title, 20) }} --}}
                                        {{ $entry->title }}
                                    </a>
                                </td>
                                <td class="px-2">{{ $entry->type_name }}</td>
                                <td class="px-2">{{ $entry->category_name }}</td>
                                <td class="px-2">{{ date('d-m-Y', strtotime($entry->created)) }}</td>
                                <td class="px-2">
                                    @foreach ($entry->tags as $tag)
                                        {{ $tag->name }} <br>
                                    @endforeach
                                </td>
                                <td class="text-sm text-black py-2">
                                    <div class="flex flex-col justify-between items-center gap-2">
                                        @foreach ($entry->files as $file)
                                            @switch($file->media_type)
                                                @case('application/vnd.ms-excel')
                                                    <i class="py-2 fa-lg fa-regular fa-file-excel" title="{{ $file->original_filename }}"></i>
                                                @break

                                                @case('text/csv')
                                                    <i class="py-2 fa-lg fa-solid fa-file-csv" title="{{ $file->original_filename }}"></i>
                                                @break

                                                @case('text/plain')
                                                    <i class="py-2 fa-lg fa-regular fa-file-lines" title="{{ $file->original_filename }}"></i>
                                                @break

                                                @case('application/javascript')
                                                    <i class="py-2 fa-lg fa-brands fa-js" title="{{ $file->original_filename }}"></i>
                                                @break

                                                @case('application/pdf')
                                                    <a href="{{ asset('storage/' . $file->path) }}">
                                                        <i class="py-2 fa-lg fa-regular fa-file-pdf" title="{{ $file->original_filename }}"></i>
                                                    </a>
                                                @break

                                                @case('text/html')
                                                    <i class="py-2 fa-lg fa-brands fa-html5" title="{{ $file->original_filename }}"></i>
                                                @break

                                                @case('text/x-php')
                                                    <i class="py-2 fa-lg fa-brands fa-php" title="{{ $file->original_filename }}"></i>
                                                @break

                                                @case('application/vnd.oasis.opendocument.text')
                                                    <i class="py-2 fa-lg fa-regular fa-file-word" title="{{ $file->original_filename }}"></i>
                                                @break

                                                @case('application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                                    <i class="py-2 fa-lg fa-regular fa-file-word" title="{{ $file->original_filename }}"></i>
                                                @break

                                                @case('image/jpeg')
                                                    <a href="{{ asset('storage/' . $file->path) }}">
                                                        <i class="py-2 fa-lg fa-regular fa-image" title="{{ $file->original_filename }}"></i>
                                                    </a>
                                                @break

                                                @case('image/png')
                                                    <a href="{{ asset('storage/' . $file->path) }}">
                                                        <i class="py-2 fa-lg fa-regular fa-image" title="{{ $file->original_filename }}"></i>
                                                    </a>
                                                @break

                                                @default
                                                    <i class="py-2 fa-lg fa-solid fa-triangle-exclamation text-red-600 hover:text-red-400" title="Not a valid Format"></i>
                                            @endswitch
                                            
                                        @endforeach
                                    </div>
                                </td>
                                <td class="p-2">
                                    <div class="flex justify-center items-center gap-2">
                                        <!-- Show -->
                                        <a href="{{ route('codeentry.show', $entry) }}" >
                                            <span class="text-blue-400 hover:text-black transition-all duration-500 tooltip">
                                                <i class="fa-solid fa-circle-info"></i>
                                                <span class="tooltiptext">See this Entry</span>
                                            </span>
                                        </a>
                                        <!-- Upload File -->
                                        <a href="{{ route('codefile.index', $entry) }}" data-tooltip="Upload File" data-tooltip-position="top">
                                            <span class="text-violet-400 hover:text-black transition-all duration-500"><i class="fa-solid fa-file-arrow-up"></i></span>
                                        </a>
                                        <!-- Edit -->
                                        <a href="{{ route('codeentry.edit', $entry) }}" title="Edit this entry">
                                            <span class="text-blue-600 hover:text-black transition-all duration-500"><i class="fa-solid fa-pen-to-square"></i></span>
                                        </a>
                                        <!-- Delete -->
                                        <form action="{{ route('codeentry.destroy', $entry) }}" method="POST">
                                            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                                            @csrf
                                            <!-- Dirtective to Override the http method -->
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure you want to delete the entry: {{ $entry->title }}?')" title="Delete this entry">
                                                <span class="text-red-600 hover:text-black transition-all duration-500"><i class="fa-solid fa-trash"></i></span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            @else
                <div class="bg-zinc-100 py-6 rounded-lg border-2 border-red-600">
                    <span class="text-md text-red-600 font-semibold px-4">No Entries found
                        <a wire:click.prevent="resetAll" title="Reset">
                            <i class="fa-lg fa-solid fa-circle-xmark hover:text-red-400 cursor-pointer px-2"></i>
                        </a>
                    </span>
                </div>
            @endif

        </div>

    </div>

    <!-- Pagination Links -->
    <div class="py-2 px-4">
        {{ $entries->links() }}
    </div>
    <!-- Footer -->
    <div class="flex flex-row justify-end items-center py-4 px-4 bg-green-400 sm:rounded-b-lg">
        <a href="{{ route('dashboard') }}">
            <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out" title="Go Back"></i>
        </a>
    </div>

</div>

