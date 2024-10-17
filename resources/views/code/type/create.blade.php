<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>

    <div class="container max-w-6xl mx-auto">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-center py-2 px-2 text-slate-400">
            <a href="/dashboard" class="px-2 hover:text-green-600">Dashboard </a> /            
            <a href="/dashboard/type" class="px-2 hover:text-green-600">Types</a> /
            <a href="/dashboard/type/create" class="px-2 font-bold text-black border-b-2 border-b-green-600">New</a>
        </div>        
        <livewire:code.type.create />
    </div>

</x-app-layout>
