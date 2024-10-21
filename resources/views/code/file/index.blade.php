<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <div class="container max-w-6xl mx-auto">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-center py-2 px-2 text-slate-400">
            <a href="/dashboard/entry" class="px-2 hover:text-green-600">Entries</a> /
            <a href="/dashboard/entry/{{ $entry->id }}" class="px-2 hover:text-green-600">Info</a> /
            <a href="/dashboard/entry/{{ $entry->id }}/file" class="px-2 font-bold text-black border-b-2 border-b-green-600">Upload</a>
        </div>
        <livewire:code.file.upload :entry="$entry" />
    </div>
</x-app-layout>
