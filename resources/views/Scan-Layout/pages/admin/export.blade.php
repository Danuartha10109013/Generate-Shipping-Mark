<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Excel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

<h3>Data Scan Layout</h3>

<table>
    <tr>
        <th>TimeStamp</th>
        <th>Responden</th>
        <th>Attribute</th>
        <th>Layout</th>
        <th>Kondisi</th>
        <th>Group</th>
      
    </tr>
    @foreach ($data as $d)
    <tr>
        <td>{{$d->created_at}}</td>
        <td>
            @php
                $name = \App\Models\User::where('id',$d->user_id)->value('name');
            @endphp
            {{$name}}
        </td>
        <td>{{$d->attribute}}</td>
        <td>{{$d->layout}}</td>
        <td>{{$d->kondisi}}</td>
        <td>GROUP {{$d->group}}</td>
       
        
    </tr>
    @endforeach

</table>

</body>
</html>