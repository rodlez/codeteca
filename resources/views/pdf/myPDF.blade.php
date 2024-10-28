<!DOCTYPE html>
<html>

<head>
    <title>Entry Information - ID({{ $id }})</title>
    <!-- CSS, DomPDF requires using the absolute local path to the CSS file -->
    <link href="{{ public_path('css/pdfTable.css') }}" rel="stylesheet">    
</head>

<body>
    <div class="container">

        <table>

            {{-- <thead> --}}
                <tr>
                    <td class="tdHeader" colspan="2">Entry Information</td>
                </tr>
            {{-- </thead> --}}

            <tbody>
                <tr>
                    <td class="tdInfo">Id</td>
                    <td>{{ $id }}</td>
                </tr>
                <tr>
                    <td class="tdInfo">User</td>
                    <td>{{ $user_name }}</td>
                </tr>
                <tr>
                    <td class="tdInfo">Title</td>
                    <td>{{ $title }}</td>
                </tr>
                <tr>
                    <td class="tdInfo">Date</td>
                    <td>{{ $date }}</td>
                </tr>
                <tr>
                    <td class="tdInfo">Type</td>
                    <td><span class="badge_type">{{ $type_name }}</span></td>
                </tr>
                <tr>
                    <td class="tdInfo">Category</td>
                    <td><span class="badge_category">{{ $category_name }}</span></td>
                </tr>
                <tr>
                    <td class="tdInfo">Tags</td>
                    <td>
                        @foreach ($tag_names as $tag)
                            <span class="badge_tag">{{ $tag }}</span>
                        @endforeach
                    </td>
                </tr>
                @if (isset($urls))
                    <tr>
                        <td class="tdInfo">Urls</td>
                        <td>
                            @foreach ($urls as $url)
                                <span class="url">{{ $url }}</span>
                            @endforeach
                        </td>
                    </tr>
                @else
                    <tr>
                        <td class="tdInfo">Url</td>
                        <td>-</td>
                    </tr>
                @endif
                @if (isset($info))
                    <tr>
                        <td class="tdInfo">Info</td>
                        <td>{!! $info !!}</td>
                    </tr>
                @else
                    <tr>
                        <td class="tdInfo">Info</td>
                        <td>-</td>
                    </tr>
                @endif
                @if (isset($code))
                    <tr>
                        <td class="tdInfo">Code</td>
                        <td>
                            <pre class="code_text">{{ $code }}</pre>
                        </td>    
                    </tr>
                @else
                    <tr>
                        <td class="tdInfo">Code</td>
                        <td>-</td>
                    </tr>
                @endif
                @if (isset($files))
                    <tr>
                        <td class="tdInfo">Files</td>
                        <td>
                            <table>
                                <thead>
                                    <th></th>
                                    <th></th>
                                    {{-- <th style="text-align:left; padding-left: 15px;">Filename</th> --}}
                                    {{-- <th>Size (KB)</th> --}}
                                    {{-- <th>Format</th> --}}
                                </thead>

                                @foreach ($files as $file)
                                    <tbody>
                                        <tr>
                                            @include('pdf.partial-media-file', $file)
                                            {{-- <td><img src="{{ public_path('storage/' . $file['path']) }}"
                                                    width="100"></td> --}}
                                            <td>{{ $file['original_filename'] }}</td>
                                            {{-- <td>{{$file['size']}}</td> --}}
                                            {{-- <td>{{$file['media_type']}}</td> --}}
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td class="tdInfo">Files</td>
                        <td>-</td>
                    </tr>
                @endif
            </tbody>            

        </table>

    </div>

</body>

</html>
