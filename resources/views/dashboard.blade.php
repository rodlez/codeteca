<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} 
        </h2>
    </x-slot --}}

    

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-yellow-400 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 text-white bg-green-600">
                    {{ __("You're logged in!") }}
                </div>

                <div class="p-6">
                    <a href="{{ route('code.main') }}">
                        Main
                    </a>
                </div>

                {{-- <div class="p-6">
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
                </div> --}}


            </div>           

        </div>

   

</x-app-layout>
