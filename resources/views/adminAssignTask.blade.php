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
@extends('dash')
@section('content')
    <div class="flex flex-col sm:rounded-lg py-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <form class="bg-white shadow-sm rounded-lg p-5 flex flex-col gap-2" action="{{route('newtaskAssign')}}"  method="POST" enctype="multipart/form-data">
    @csrf
    <h1 class="font-bold text-2xl">Email</h1>
    <input type="email" class="p-2 w-full"  name="email" required placeholder="User Email" id="">
    <h1 class="font-bold text-2xl">Title</h1>
    <input type="text" class="p-2 w-full"  name="title" required placeholder="title" id="">
    <h1 class="font-bold text-2xl">Description</h1>
    <input type="text" class="p-2 w-full"  required name="description" placeholder="description" id="">
    <h1 class="font-bold text-2xl">Category</h1>
    <input type="text" class="p-2 w-full"   name="category" placeholder="category" id="">
    <h1 class="font-bold text-2xl">Assignfrom</h1>
    <input type="email" class="p-2 w-full"   name="assignfrom" placeholder="assignfrom" id="">
    <h1 class="font-bold text-2xl">Assignto</h1>
    <input type="email" class="p-2 w-full"  name="assignto" placeholder="assignto" id="">
    <h1 class="font-bold text-2xl">Comments</h1>
    <input type="text" class="p-2 w-full"   name="comments" placeholder="comments" id="">
    <span class="flex items-center gap-2">
    <h1 class="font-bold text-2xl">Status</h1>
    <div class="flex gap-5 mb-2">
        <span class="flex items-center gap-2">
            <input value="pending" type="radio" checked  name="status" id="pending"><h1>Pending</h1>
        </span>
        <span class="flex items-center gap-2">
            <input value="in progress" type="radio"  name="status" id="progress"><h1>In Progress</h1>
        </span>
        <span class="flex items-center gap-2">
            <input value="completed" type="radio"  name="status" id="completed"><h1>Completed</h1>
        </span>
        </div>
    </span>
        <span class="flex gap-2">
            <h1 class="font-bold text-2xl">Add File</h1>
            <input type="file" name="file" id="">
        </span>
   
        <button class="bg-btn p-2 mt-4 text-white font-bold">Assign to User</button>
    </form>
      
        </div>
@endsection
</body>
</html>