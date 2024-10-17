<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-center py-2 px-2 text-slate-400">
            <a href="/dashboard/type" class="px-2 font-bold text-black border-b-2 border-b-orange-600">Types</a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
            <livewire:code.type.main />

        </div>

    </div>

</x-app-layout>
