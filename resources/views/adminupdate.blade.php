@extends('dash')
@section('content')
    <div class="flex flex-col sm:rounded-lg py-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
    @foreach($userdata as $data)
    <form class="bg-white shadow-sm rounded-lg p-5 flex flex-col gap-2" action="{{route('updateUserDetails',$data->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <h1 class="font-bold text-2xl">Title</h1>
    <input type="text" class="p-2 w-full" value="{{$data->title}}"  name="title" placeholder="title" id="">
    <h1 class="font-bold text-2xl">Description</h1>
    <input type="text" class="p-2 w-full"  value="{{$data->description}}" name="description" placeholder="description" id="">
    <h1 class="font-bold text-2xl">Category</h1>
    <input type="text" class="p-2 w-full"  value="{{$data->category}}" name="category" placeholder="category" id="">
    <h1 class="font-bold text-2xl">Assignfrom</h1>
    <input type="text" class="p-2 w-full"  value="{{$data->assignfrom}}" name="assignfrom" placeholder="assignfrom" id="">
    <h1 class="font-bold text-2xl">Assignto</h1>
    <input type="text" class="p-2 w-full"  value="{{$data->assignto}}" name="assignto" placeholder="assignto" id="">
    <h1 class="font-bold text-2xl">Comments</h1>
    <input type="text" class="p-2 w-full"  value="{{$data->comments}}" name="comments" placeholder="comments" id="">
    <h1 class="font-bold text-2xl">Status</h1>
    <div class="flex gap-5 mb-2">
        <span class="flex items-center gap-2">
            <input value="pending" type="radio" {{ ($data->status=="pending")? "checked" : "" }} name="status" id="pending"><h1>Pending</h1>
        </span>
        <span class="flex items-center gap-2">
            <input value="in progress" type="radio" {{ ($data->status=="in progress")? "checked" : "" }} name="status" id="progress"><h1>In Progress</h1>
        </span>
        <span class="flex items-center gap-2">
            <input value="completed" type="radio" {{ ($data->status=="completed")? "checked" : "" }} name="status" id="completed"><h1>Completed</h1>
        </span>
        </div>
        <button class="bg-btn p-2 mt-4 text-white font-bold">Update UserInformation</button>
    </form>
        @endforeach
        </div>
@endsection