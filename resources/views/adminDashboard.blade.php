<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap4.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap4.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="p-2">
        <a href="{{route('adminAssignTask')}}"><button type="button" class="btn btn-success m-1">Assign new Task</button></a>
        <a href="/dashboard"><button type="button" class="btn btn-secondary m-1">Dashboard</button></a>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>Id</th>
                <th>Email</th>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>File</th>
                <th>Assignfrom</th>
                <th>AssignTo</th>
                <th>Comments</th>
                <th>CommentsBy</th>
                <th>CommentsTime</th>
                <th>Created_At</th>
                <th>Updated_At</th>
                <th>Status</th>
                <th>Update</th>
                <th>Delete</th>
                
            </tr>
        </thead>
        <tbody>  
            @foreach($userData as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->title}}</td>
                <td>{{$data->description}}</td>
                <td>{{$data->category}}</td>
                <td>{{$data->file}}</td>
                <td>{{$data->assignfrom}}</td>
                <td>{{$data->assignto}}</td>
                <td>{{$data->comments}}</td>
                <td>{{$data->commentsby}}</td>
                <td>{{$data->commentstime}}</td>
                <td>{{$data->created_at}}</td>
                <td>{{$data->updated_at}}</td>
                <td>{{$data->status}}</td>  
                <td onclick="myFunction()" ><a href="admin/update/{{$data->id}}"><button type="button" class="btn btn-warning">Update</button></a></td>
                {{-- <td><a href="/admin/delete/{{$data->id}}"><button type="button" class="btn btn-danger">Delete</button></a></td> --}}
                <td id="aaa"><a href="/admin/delete/{{$data->id}}"><button class="btn btn-danger" >DELETE</button></a></td>
            </tr>
                @endforeach
        </tbody>
    </table>
</div>

</body>
<script>
    $('#example').DataTable();   
</script>
</html>