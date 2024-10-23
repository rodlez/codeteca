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
        <td class="py-2">
            <a href="{{ asset('storage/' . $file->path) }}">
                <img src="{{ asset('storage/' . $file->path) }}" class="w-12 md:w-24 mx-auto rounded-lg"
                    title="{{ $file->original_filename }}">
            </a>
        </td>
    @break

    @case('image/png')
        <td class="py-2">
            <a href="{{ asset('storage/' . $file->path) }}">
                <img src="{{ asset('storage/' . $file->path) }}" class="w-12 md:w-24 mx-auto rounded-lg"
                    title="{{ $file->original_filename }}">
            </a>
        </td>
    @break

    @default
        <td class="py-2"><i class="fa-2x fa-solid fa-triangle-exclamation text-red-600 hover:text-red-400"
                title="Not a valid Format"></i></td>
@endswitch
