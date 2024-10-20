<div>

    <!-- Header -->
    <div class="flex flex-row justify-between items-center py-4 bg-black">
        <div>
            <span class="text-lg text-white px-4">Types <span class="text-sm">({{ $search != '' ? $found : $total }})</span></span>
        </div>
        <div class="px-4">
            <a href="{{ route('codetype.create') }}" class="text-white text-sm sm:text-md rounded-lg py-2 px-4 bg-orange-600 hover:bg-orange-400 transition duration-1000 ease-in-out" title="Create New Type">New</a>
        </div>
    </div>
    <!-- Search -->
    <div class="flex flex-col sm:flex-row justify-between items-start px-2 sm:px-4 py-4 gap-4">
        <!-- Search -->
        <div class="relative w-full">
            <div class="absolute top-2.5 bottom-0 left-4 text-slate-700">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <input wire:model.live="search" type="search" class="w-full rounded-lg pl-10 placeholder-zinc-400 focus:outline-none focus:ring-0 focus:border-orange-600 border-2 border-zinc-200" placeholder="Search by name">
        </div>
        <!-- Pagination -->
        <div class="relative w-32">
            <div class="absolute top-2.5 bottom-0 left-4 text-slate-700">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <select wire:model.live="perPage" class="w-full rounded-lg text-end focus:outline-none focus:ring-0 focus:border-orange-600 border-2 border-zinc-200 ">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>
    <!-- Bulk Actions -->
    @if (count($selections) > 0)
        <div class="px-4">
            <div class="flex flex-row justify-start items-end gap-4 py-2 px-4 mb-2 rounded-lg bg-zinc-200">
                <span class="text-sm font-semibold">Bulk Actions</span>
                <a wire:click.prevent="bulkClear" class="cursor-pointer" title="Unselect All">
                    <span><i class="fa-solid fa-rotate-right text-green-600 hover:text-green-500"></i></span>
                </a>
                <a wire:click.prevent="bulkDelete" wire:confirm="Are you sure you want to delete this items?" class="cursor-pointer text-red-600 hover:text-red-500" title="Delete">
                    <span><i class="fa-solid fa-trash"></i></span>
                    <span>({{ count($selections) }})</span>
                </a>
            </div>
        </div>
    @endif
    <!-- Table -->
    <div class="px-0 sm:px-4 pb-0 ">
        <div class="overflow-x-auto">

            @if ($types->count())
                <table class="min-w-full ">
                    <thead>
                        <tr class="bg-black text-white text-left text-sm font-normal uppercase">
                            <th></th>
                            <th wire:click="sorting('id')" scope="col" class="p-2 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'id' ? 'text-yellow-400' : '' }}">id {!! $sortLink !!}</th>
                            <th wire:click="sorting('name')" scope="col" class="p-2 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'name' ? 'text-yellow-400' : '' }}">name {!! $sortLink !!}</th>
                            <th wire:click="sorting('created_at')" scope="col" class="p-2 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'created_at' ? 'text-yellow-400' : '' }}">created {!! $sortLink !!}</th>
                            <th wire:click="sorting('updated_at')" scope="col" class="p-2 hover:cursor-pointer hover:text-yellow-400 {{ $column == 'updated_at' ? 'text-yellow-400' : '' }}">updated {!! $sortLink !!}</th>
                            <th scope="col" class="p-2 text-center"> actions </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($types as $type)
                            <tr class="even:bg-zinc-200 odd:bg-gray-300 transition-all duration-1000 hover:bg-yellow-400">
                                <td class="p-2 whitespace-nowrap text-md text-center leading-6 font-medium text-gray-900"><input wire:model.live="selections" type="checkbox" class="text-green-600 outline-none focus:ring-0 checked:bg-green-500" value={{ $type->id }}></td>
                                <td class="p-2 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ $type->id }}</td>
                                <td class="p-2 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ $type->name }}</td>
                                <td class="p-2 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ date('d-m-Y', strtotime($type->created_at)) }}</td>
                                <td class="p-2 whitespace-nowrap text-md leading-6 font-medium text-gray-900">{{ date('d-m-Y', strtotime($type->updated_at)) }}</td>
                                <td class="p-2">
                                    <div class="flex justify-center items-center gap-2">                                        
                                        <!-- Show -->
                                        <a href="{{ route('codetype.show', $type) }}" title="Show">
                                            <span class="text-green-600 hover:text-black transition-all duration-500"><i class="fa-solid fa-circle-info"></i></span>
                                        </a>
                                        <!-- Edit -->
                                        <a href="{{ route('codetype.edit', $type) }}" title="Edit">
                                            <span class="text-blue-600 hover:text-black transition-all duration-500"><i class="fa-solid fa-pen-to-square"></i></span>
                                        </a>
                                        <!-- Delete -->
                                        <form action="{{ route('codetype.destroy', $type) }}" method="POST">
                                            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                                            @csrf
                                            <!-- Dirtective to Override the http method -->
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure you want to delete the type: {{ $type->name }}?')" title="Delete">
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
                <div class="bg-zinc-200 text-red-600 rounded-lg p-4 mx-2 sm:mx-0">
                    <span>No types found</span>
                        <a wire:click.prevent="clearSearch" title="Reset">
                            <i class="fa-lg fa-solid fa-circle-xmark px-2"></i>
                        </a>
                    </span>
                </div>
            @endif

        </div>

    </div>
    <!-- Pagination Links -->
    <div class="py-2 px-4">
        {{ $types->links() }}
    </div>
    <!-- Footer -->
    <div class="py-4 flex flex-row justify-end items-center px-4 bg-black sm:rounded-b-lg">
        <a href="{{ route('dashboard') }}">
            <i class="fa-lg fa-solid fa-backward-step text-orange-600 hover:text-orange-400 transition duration-1000 ease-in-out" title="Go Back"></i>
        </a>
    </div>

</div>

