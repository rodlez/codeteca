<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <div class="container max-w-6xl mx-auto px-6 py-4">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-center py-2 px-2 text-slate-400">
            <a href="/dashboard" class="px-2 hover:text-green-600">Dashboard </a> /
            <a href="/dashboard/type" class="px-2 hover:text-green-600">Types</a> /
            <a href="/dashboard/type/{{ $type->id }}" class="px-2 font-bold text-black border-b-2 border-b-green-500">Info</a>
        </div>

        <div class="bg-white shadow rounded-xl mx-4">

            <!-- Header -->
            <div class="flex flex-row justify-between items-center py-4 bg-green-600 rounded-t-lg">
                <div>
                    <i class="fa-lg sm:fa-2x fa-solid fa-laptop-code pl-4 text-white"></i>
                    <span class="text-lg text-white px-4">Type Info</span>
                </div>

            </div>
            <!-- Info -->
            <div class="mx-auto w-11/12 py-4 px-2">
                <div><span class="text-md font-semibold px-4">Name</span></div>
                <div class="flex flex-row justify-start items-center gap-4 py-2">

                    <input type="text" id="name" class="bg-zinc-200 border border-zinc-300 text-gray-900 text-md rounded-lg w-full sm:w-1/2 pl-4 p-2  dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" value="{{ $type->name }}" disabled>
                    <!-- Edit -->
                    <a href="{{ route('codetype.edit', $type) }}">
                        <i class="fa-solid fa-pencil text-green-600 hover:text-green-400 transition duration-1000 ease-in-out" title="Edit"></i>
                    </a>
                    <!-- Delete -->
                    <form action="{{ route('codetype.destroy', $type) }}" method="POST">
                        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                        @csrf
                        <!-- Dirtective to Override the http method -->
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure you want to delete the type: {{ $type->name }}?')">
                            <i class="text-red-600 hover:text-red-400 fa-solid fa-trash" title="Delete"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Footer -->
            <div class="py-4 flex flex-row justify-end items-center px-4 bg-green-600 rounded-b-lg">
                <a href="{{ route('codetype.index') }}">
                    <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out" title="Go Back"></i>
                </a>
            </div>

        </div>

    </div>

</x-app-layout>
