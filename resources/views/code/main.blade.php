<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="overflow-hidden shadow-sm sm:rounded-lg my-4">

            <div class="p-6 my-4 rounded-lg text-white bg-green-600">
                Notifications
            </div>

            <!-- MAIN MENU -->
            <div class="flex flex-col sm:flex-row sm:flex-wrap sm:justify-center sm:w-full py-10 px-4 gap-4 rounded-lg bg-white">
                
                <a href="{{ route('codeentry.index') }}">
                    <div class="flex flex-col justify-center items-center w-52 h-52 mx-auto gap-4 rounded-lg text-black hover:text-white bg-green-200 hover:bg-green-600 transition duration-1000 ease-in-out">
                        <i class="fa-4x fa-solid fa-code"></i>
                        <span class="font-bold">Entries ({{ $totalEntries }})</span>
                    </div>
                </a>

                <a href="{{ route('codetype.index') }}">
                    <div class="flex flex-col justify-center items-center w-52 h-52 mx-auto gap-4 rounded-lg bg-yellow-200 hover:bg-yellow-400 transition duration-1000 ease-in-out">
                        <i class="fa-4x fa-solid fa-sitemap"></i>
                        <span class="font-bold">Types ({{ $totalTypes }})</span>
                    </div>
                </a>

                <a href="{{ route('codecategory.index') }}">
                    <div class="flex flex-col justify-center items-center w-52 h-52 mx-auto gap-4 rounded-lg bg-blue-200 hover:bg-blue-400 transition duration-1000 ease-in-out">
                        <i class="fa-4x fa-solid fa-list"></i>
                        <span class="font-bold">Categories ({{ $totalCategories }})</span>
                    </div>
                </a>

                <a href="{{ route('codetag.index') }}">
                    <div class="flex flex-col justify-center items-center w-52 h-52 mx-auto gap-4 rounded-lg bg-orange-200 hover:bg-orange-400 transition duration-1000 ease-in-out">
                        <i class="fa-4x fa-solid fa-tags"></i>
                        <span class="font-bold">Tags ({{ $totalTags }})</span>
                    </div>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>
