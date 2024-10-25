<x-app-layout>
    <div class="max-w-7xl mx-auto sm:pb-8 sm:px-6 lg:px-8">
        <!-- Sitemap -->
        <div class="flex flex-row justify-start items-start gap-1 text-sm py-3 px-4 text-slate-500">
            <a href="/dashboard/entry" class="hover:text-green-600">Entries</a> /
            <a href="/dashboard/entry/{{ $entry->id }}" class="hover:text-green-600">Info</a> /
            <a href="/dashboard/entry/edit/{{ $entry->id }}" class="font-bold text-black border-b-2 border-b-green-600">Edit</a>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <livewire:code.entry.edit :entry="$entry" />
        </div>
    </div>
</x-app-layout>
