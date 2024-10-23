 @switch($file->media_type)
    @case('application/vnd.ms-excel')
        <a href="{{ route('codefile.download', [$entry, $file]) }}">
            <i class="py-2 fa-lg fa-regular fa-file-excel" title="Download File {{ $file->original_filename }}"></i>
        </a>
    @break

    @case('text/csv')
        <a href="{{ route('codefile.download', [$entry, $file]) }}">
            <i class="py-2 fa-lg fa-solid fa-file-csv" title="Download File {{ $file->original_filename }}"></i>
        </a>
    @break

    @case('text/plain')
        <a href="{{ route('codefile.download', [$entry, $file]) }}">
            <i class="py-2 fa-lg fa-regular fa-file-lines" title="Download File {{ $file->original_filename }}"></i>
        </a>
    @break

    @case('application/javascript')
        <a href="{{ route('codefile.download', [$entry, $file]) }}">
            <i class="py-2 fa-lg fa-brands fa-js" title="Download File {{ $file->original_filename }}"></i>
        </a>
    @break

    @case('application/pdf')
        <a href="{{ asset('storage/' . $file->path) }}">
            <i class="py-2 fa-lg fa-regular fa-file-pdf" title="Open File {{ $file->original_filename }}"></i>
        </a>
    @break

    @case('text/html')
        <a href="{{ route('codefile.download', [$entry, $file]) }}">
            <i class="py-2 fa-lg fa-brands fa-html5" title="Download File {{ $file->original_filename }}"></i>
        </a>
    @break

    @case('text/x-php')
        <a href="{{ route('codefile.download', [$entry, $file]) }}">
            <i class="py-2 fa-lg fa-brands fa-php" title="Download File {{ $file->original_filename }}"></i>
        </a>
    @break

    @case('application/vnd.oasis.opendocument.text')
        <a href="{{ route('codefile.download', [$entry, $file]) }}">
            <i class="py-2 fa-lg fa-regular fa-file-word" title="Download File {{ $file->original_filename }}"></i>
        </a>
    @break

    @case('application/vnd.openxmlformats-officedocument.wordprocessingml.document')
        <a href="{{ route('codefile.download', [$entry, $file]) }}">
            <i class="py-2 fa-lg fa-regular fa-file-word" title="Download File {{ $file->original_filename }}"></i>
        </a>
    @break

    @case('image/jpeg')
        <a href="{{ asset('storage/' . $file->path) }}">
            <i class="py-2 fa-lg fa-regular fa-image" title="Open File {{ $file->original_filename }}"></i>
        </a>
    @break

    @case('image/png')
        <a href="{{ asset('storage/' . $file->path) }}">
            <i class="py-2 fa-lg fa-regular fa-image" title="Open File {{ $file->original_filename }}"></i>
        </a>
    @break

    @default
        <i class="py-2 fa-lg fa-solid fa-triangle-exclamation text-red-600 hover:text-red-400" title="Not a valid Format"></i>
@endswitch 
