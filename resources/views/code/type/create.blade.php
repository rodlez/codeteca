<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>

    <div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500">
            <a href="/dashboard/type" class="hover:text-yellow-600">Types</a> /
            <a href="/dashboard/type/create" class="font-bold text-black border-b-2 border-b-yellow-600">New</a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <livewire:code.type.create />
        </div>
    </div>

</x-app-layout>
