<!DOCTYPE html>
<html>
<head>
    <title>Entry Information - ID({{$id}})</title>
    <style>
        body {
            font-family: 'Arial, sans-serif';
        }
        .container {
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: left;
            margin-bottom: 20px;
        }
        .content {
            font-size: 12px;
        }
        .badge {
            background-color: yellow;
            font-size: 0.8rem;
            font-weight: bold;
            color: black;
            border-radius: 10px;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <p>Id: {{ $id }}</p>
            <p>Title: {{ $title }}</p>
            <p>User: {{ $user_name }}</p>
            <div>
                <span class="badge">{{ $type_name }}</span>
            </div>
            <p>Type: {{ $type_name }}</p>
            <p>Category: {{ $category_name }}</p>
            <p>Tags: {{ $tag_names }}</p>
            <p>Date: {{ $created_at }}</p>
            <p>URL: {{ $url }}</p>
            <p>Info: {!! $info !!}</p>
            <p>Code: {{ $code }}</p>            
        </div>
        <div class="content">
            <p>This is an example of a PDF document generated using Laravel and DomPDF.</p>
        </div>
    </div>
</body>
</html>

