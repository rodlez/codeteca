<div class="bg-white shadow rounded-xl mx-4">

    <!-- Header -->
    <div class="flex flex-row justify-between py-4 bg-green-600 rounded-t-lg">
        <div class="flex items-baseline">
            <i class="fa-lg md:fa-2x fa-solid fa-laptop-code pl-8 text-white"></i>
            <span class="text-lg text-white px-2">Upload File </span>
        </div>
    </div>

    {{-- {{ request()->headers->get('referer') }} --}}

    <div class="flex flex-col md:flex-row mx-16 my-2 pt-4 pb-1 border-b-2 border-b-green-600 text-xl font-semibold">
        <div>Entry <span class="text-sm"> (ID: {{ $entry->id }})</div>
        <div>Title <span class="text-gray-600 text-md font-normal">{{ excerpt($entry->title, 50) }}</span></div>
    </div>

    <div class="mx-16 py-1 text-xs font-semibold">Files in this entry ({{ $entry->files->count() }} of 5)</div>

    @if ($entry->files->count() > 0)
        <div class="mx-16 py-2 flex flex-col md:flex-row justify-start items-center w-fit px-4 border-2 rounded-lg gap-4 bg-gray-200">
            @foreach ($entry->files as $file)
                <div class="relative py-2">
                   {{--  @if ($file->media_type === 'application/pdf')
                        <a href="{{ asset('storage/' . $file->path) }}" title="{{ $file->original_filename }}">
                            <i class="fa-regular fa-file-pdf fa-3x"></i>
                        </a>
                    @else
                        <a href="{{ asset('storage/' . $file->path) }}">
                            <img src="{{ asset('storage/' . $file->path) }}" class="w-full md:w-12 md:h-12 mx-auto rounded-lg" title="{{ $file->original_filename }}">
                        </a>
                    @endif --}}
                    @switch($file->media_type)
                    @case('application/vnd.ms-excel')
                        <td class="py-2"><i class="fa-2x fa-regular fa-file-excel"></i></td>
                    @break

                    @case('text/csv')
                        <td class="py-2"><i class="fa-2x fa-solid fa-file-csv"></i></td>
                    @break

                    @case('text/plain')
                        <td class="py-2"><i class="fa-2x fa-regular fa-file-lines"></i></td>
                    @break

                    @case('application/javascript')
                        <td class="py-2"><i class="fa-2x fa-brands fa-js"></i></td>
                    @break

                    @case('application/pdf')
                    <a href="{{ asset('storage/' . $file->path) }}" title="{{ $file->original_filename }}">
                        <i class="fa-regular fa-file-pdf fa-3x"></i>
                    </a>
                    @break

                    @case('text/html')
                        <td class="py-2"><i class="fa-2x fa-brands fa-html5"></i></td>
                    @break

                    @case('text/x-php')
                        <td class="py-2"><i class="fa-2x fa-brands fa-php"></i></td>
                    @break

                    @case('application/vnd.oasis.opendocument.text')
                        <td class="py-2"><i class="fa-2x fa-regular fa-file-word"></i></td>
                    @break

                    @case('application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                        <td class="py-2"><i class="fa-2x fa-regular fa-file-word"></i></td>
                    @break

                    @case('image/jpeg')
                    <a href="{{ asset('storage/' . $file->path) }}">
                        <img src="{{ asset('storage/' . $file->path) }}" class="w-full md:w-12 md:h-12 mx-auto rounded-lg" title="{{ $file->original_filename }}">
                    </a>
                    @break

                    @case('image/png')
                    <a href="{{ asset('storage/' . $file->path) }}">
                        <img src="{{ asset('storage/' . $file->path) }}" class="w-full md:w-12 md:h-12 mx-auto rounded-lg" title="{{ $file->original_filename }}">
                    </a>
                    @break

                    @default
                        <td class="py-2"><i class="fa-2x fa-solid fa-triangle-exclamation text-red-600 hover:text-red-400" title="Not a valid Format"></i></td>
                @endswitch
                    <!-- Delete file -->
                    <form action="{{ route('codefile.destroy', [$entry, $file]) }}" method="POST">
                        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                        @csrf
                        <!-- Dirtective to Override the http method -->
                        @method('DELETE')
                        <button class="absolute top-0 right-0" onclick="return confirm('Are you sure you want to delete the file: {{ $file->original_filename }}?')" title="Delete file">
                            <span class="text-red-600 hover:text-red-700 transition-all duration-500"><i class="fa-solid fa-circle-xmark fa-md"></i></i></span>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif

    @if ($entry->files->count() >= 5)
        <div class="mx-16 py-4 text-lg text-red-400 font-semibold">You have reached the limit of files for this entry. Delete some to upload new ones.</div>
        <div class="mx-16 py-8">
            <!-- Back -->
            <a href="{{ route('sportentry.show', $entry) }}" class="w-full md:w-1/3 bg-black hover:bg-slate-600 text-white text-center font-bold py-2 px-4 rounded-md">
                Back
            </a>
        </div>
    @else
        <div class="mx-16 py-4">
            <form wire:submit.prevent="save">
                <label class="text-lg text-gray-500 font-semibold mb-2 block">Upload files</label>
                <input wire:model.live="files" multiple
                       type="file"
                       class="w-full text-gray-400 font-semibold text-sm bg-white border file:cursor-pointer cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4 file:bg-black file:hover:bg-slate-600 file:text-white rounded ease-linear transition-all duration-500" />
                <p class="text-xs text-black font-semibold mt-2">Allowed formats: PDF, JPG, JPEG, PNG, JS, HTML, CSV, XLS, TXT, DOC, ODT.</p>

                @if (count($files) + $entry->files->count() > 5)
                    <div class="my-4">
                        <span class="text-red-600 font-semibold">You have reached the limit of files ({{ count($files) + $entry->files->count() }}) for this entry. Delete some to upload new ones.</span>
                    </div>
                @else
                    <button class="bg-black hover:bg-slate-600 text-white font-bold uppercase text-sm px-6 py-3 my-4 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-500" type="submit">
                        <i class="fa-solid fa-file-arrow-up fa-lg px-1"></i> Upload
                    </button>
                @endif

                @error('files')
                    <div class="mt-4 mb-0 py-2 text-sm text-red-600 font-semibold">{{ $message }}</div>
                @enderror
                @error('files.*')
                    @if ($message == 'At least one file is not one of the allowed formats: PDF, JPG, JPEG or PNG')
                        <div class="mt-4 mb-0 py-2 text-sm text-red-600 font-semibold"><i class="fa-solid fa-triangle-exclamation fa-2xl pr-2"></i> {{ $message }}</div>
                    @else
                        <div class="mt-4 mb-0 py-2 text-sm text-red-600 font-semibold">{{ $message }}</div>
                    @endif
                @enderror
            </form>
        </div>

        <div class="mx-16 mb-12">
            @if (count($files) !== 0)
                <div class="py-0"><span class="text-lg px-2">Files selected ({{ count($files) }})</span></div>

                <table class="table-auto w-full">
                    <thead class="text-sm text-center text-white bg-black h-10">
                        <th class="rounded-tl-lg"></th>
                        <th>Filename</th>
                        <th class="max-md:hidden">Size (KB)</th>
                        <th class="max-md:hidden">Format</th>
                        <th class="rounded-tr-lg"></th>
                    </thead>

                    <tbody>

                        @php($position = 0)
                        @foreach ($files as $file)
                            <tr class="text-center even:bg-zinc-200 odd:bg-white">

                                @switch($file->getMimeType())
                                    @case('application/vnd.ms-excel')
                                        <td class="py-2"><i class="fa-2x fa-regular fa-file-excel"></i></td>
                                    @break

                                    @case('text/csv')
                                        <td class="py-2"><i class="fa-2x fa-solid fa-file-csv"></i></td>
                                    @break

                                    @case('text/plain')
                                        <td class="py-2"><i class="fa-2x fa-regular fa-file-lines"></i></td>
                                    @break

                                    @case('application/javascript')
                                        <td class="py-2"><i class="fa-2x fa-brands fa-js"></i></td>
                                    @break

                                    @case('application/pdf')
                                        <td class="py-2"><i class="fa-2x fa-regular fa-file-pdf"></i></td>
                                    @break

                                    @case('text/html')
                                        <td class="py-2"><i class="fa-2x fa-brands fa-html5"></i></td>
                                    @break

                                    @case('text/x-php')
                                        <td class="py-2"><i class="fa-2x fa-brands fa-php"></i></td>
                                    @break

                                    @case('application/vnd.oasis.opendocument.text')
                                        <td class="py-2"><i class="fa-2x fa-regular fa-file-word"></i></td>
                                    @break

                                    @case('application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                        <td class="py-2"><i class="fa-2x fa-regular fa-file-word"></i></td>
                                    @break

                                    @case('image/jpeg')
                                        <td class="py-2"><img class="w-12 md:w-24 mx-auto rounded-lg" src="{{ $file->temporaryURL() }}"></td>
                                    @break

                                    @case('image/png')
                                        <td class="py-2"><img class="w-12 md:w-24 mx-auto rounded-lg" src="{{ $file->temporaryURL() }}"></td>
                                    @break

                                    @default
                                        <td class="py-2"><i class="fa-2x fa-solid fa-triangle-exclamation text-red-600 hover:text-red-400" title="Not a valid Format"></i></td>
                                @endswitch

                                <td class="py-2">{{ $file->getClientOriginalName() }}</td>
                                <td class="py-2 max-w-10 max-md:hidden">{{ round($file->getSize() / 1000) }}</td>
                                {{-- <td class="py-2 max-md:hidden">{{ $file->getMimeType() }}</td> --}}
                                <td class="py-2 max-w-12 max-md:hidden">{{ $file->getClientOriginalExtension() }}</td>
                                <td class="py-2 px-2">
                                    <a wire:click="deleteFile({{ $position }})" class="cursor-pointer" title="Delete File">
                                        <span class="text-red-600 hover:text-black ease-linear transition-all duration-500"><i class="fa-solid fa-trash"></i></span>
                                    </a>
                                </td>
                            </tr>

                            @php($position++)
                        @endforeach
                    </tbody>
                    <tfoot class="h-6">
                        <tr class="bg-black ">
                            <td class="rounded-b-lg" colspan="5"></td>
                        </tr>
                    </tfoot>
                </table>
            @endif
        </div>

    @endif

    <!-- Footer -->
    <div class="py-4 flex flex-row justify-end items-center px-4 bg-green-600 rounded-b-lg">
        <a href="{{ route('codeentry.show', $entry) }}">
            <i class="fa-lg fa-solid fa-backward-step text-white hover:text-black transition duration-1000 ease-in-out" title="Go Back"></i>
        </a>
    </div>


</div>

