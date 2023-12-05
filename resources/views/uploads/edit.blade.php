<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            max-width: 500px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
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
            background-color: #2386c8;
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

<h1>Weclome to update</h1>

<form method="POST" action='{{ url("uploads/ {$upload->id}/update") }}' enctype="multipart/form-data">
    @csrf
    @method('put')
    <input type="hidden" value="{{$upload->id}}">
    <input type="file" name="upload">
    <input type="text" name="title" value="{{$upload->title}}">
    <textarea  name="content"> {{$upload->content}}</textarea>
    <input type="submit" value="Change Upload">
</form>
@if( ! empty($id) )	
    <br>
    <a href='{{url("/uploads/{$id}/{$originalName}/show")}}'>{{ $id }} {{$originalName}}</a>
    <br>
    @if(substr($upload->mimeType, 0, 5) == 'image')
        <img height="25%" width="25%" src='{{url("/uploads/{$id}/{$originalName}/show")}}'>
        <br>
    @endif
@endif
<a href="{{url("/uploads/index")}}">go back</a>
@isset($id) 
{{ $id }} <br> {{ $upload->path }} <br> {{ $originalName }} <br> {{ $upload->mimeType }}
@endisset
</div>

</body>
</html>