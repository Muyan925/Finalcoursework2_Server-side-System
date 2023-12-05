<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
}

.container {
    max-width: 500px;
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    width: 100%;
}

form {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 10px;
    font-size: 18px;
    color: #333;
}

input, textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    box-sizing: border-box;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 16px;
}

input[type="file"] {
    border: none;
}

input[type="submit"] {
    background-color: #23c2c8;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    font-size: 18px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: rgb(33, 126, 136);
}

img {
    max-width: 100%;
    height: auto;
    margin-top: 20px;
}

a {
    display: block;
    margin-top: 20px;
    color: #007bff;
    text-decoration: none;
    font-size: 16px;
}

a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>


<div class="container">
<form method="POST" action='{{url("/uploads/store")}}' enctype="multipart/form-data">
    @csrf
    <input type="file" name="upload" >

    <!-- Input fields for title and content -->
    <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter title">
    <textarea name="content" placeholder="Enter content">{{ old('content') }}</textarea>

    <input type="submit" value="Save Upload">
</form>

@if( ! empty($id) )
    <br>
    <a href='{{url("/uploads/{$id}/{$originalName}/show")}}'>{{ $id }} {{$originalName}}</a>
    <br>
    @if(substr($mimeType, 0, 5) == 'image')
        <img height="25%" width="25%" src='{{url("/uploads/{$id}/{$originalName}/show")}}'>
        <br>
    @endif
    <p>title:{{ $title }}</p>
    <p>Content:{{ $content }}</p>

@endif

<a href="{{url("/uploads/index")}}">go back</a>

@isset($id)
{{ $id }}
<br>
{{ $path }}
<br>
{{ $originalName }}
<br>
{{ $mimeType }}
@endisset
</div>

</body>
</html>