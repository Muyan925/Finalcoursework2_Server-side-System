<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to my modify page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        ol {
            padding: 0;
            margin: 0;
        }

        li {
            border: 1px solid #ddd;
            background-color: #fff;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        a {
            color:black;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        form {
            display: inline-block;
            margin-left: 10px;
        }

        input[type="submit"] {
            background-color: #35dcdc;
            color: #fff;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #23c2c8;
        }

        .index {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome to my modify page</h1>
    <ol type='1'>
        @foreach ($uploads as $index => $upload)
            <li>
                <span class="index">{{$index + 1}}</span>
                <a href='{{url("/uploads/{$upload->id}/{$upload->originalName}")}}'>{{$upload->originalName}}</a>
                <div>
                    <form method="POST" action='{{url("/uploads/{$upload->id}/edit")}}' style="display:inline!important;">
                        @csrf
                        @method('get')
                        <input type="submit" value="Edit">
                    </form>            
                    <form method="POST" action='{{url("/uploads/{$upload->id}/")}}' style="display:inline!important;">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete">
                    </form>
                </div>
            </li>
        @endforeach
    </ol>       
    @if (session('operation'))
        {{ session('operation') }} {{ session('id')  }}
    @endif   
    <a href="{{url('/uploads/create')}}" style="color: #3490dc;">Add file</a>  
</div> 

</body>
</html>
