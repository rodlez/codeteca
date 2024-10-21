<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-yellow-400 overflow-hidden shadow-sm sm:rounded-lg">

            <div class="p-6">
                <a href="{{ route('codeentry.index') }}">
                    <span>Entries ({{ $totalEntries }})</span>
                    <i class="fa-solid fa-code fa-2xl"></i>
                </a>
            </div>

            <div class="p-6">
                <a href="{{ route('codetype.index') }}">
                    <span>Types ({{ $totalTypes }})</span>
                    <i class="fa-solid fa-sitemap fa-2xl"></i>
                </a>
            </div>

            <div class="p-6">
                <a href="{{ route('codecategory.index') }}">
                    <span>Categories ({{ $totalCategories }})</span>
                    <i class="fa-solid fa-list fa-2xl"></i>
                </a>
            </div>

            <div class="p-6">
                <a href="{{ route('codetag.index') }}">
                    <span>Tags ({{ $totalTags }})</span>
                    <i class="fa-solid fa-tags fa-2xl"></i>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
