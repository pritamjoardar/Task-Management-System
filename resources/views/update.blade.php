@extends('dash')
@section('content')
<form action="{{route('update',$data->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="flex flex-col shadow-sm sm:rounded-lg py-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <input required type="text" class="p-2 text-2xl" name="title" placeholder="title" id="" value="{{$data->title}}">
        <textarea required class="mt-2 p-2 text-2xl h-52" placeholder="description" name="description" id="" cols="30" rows="10">{{$data->description}}</textarea>

        <h1 class="text-2xl mb-2">Status</h1>
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
        <h1 class="text-2xl mb-2">Comments</h1>
        <input type="text" class="mb-2" name="comments" value="{{$data->comments}}" placeholder="Add some comment" id="">
        <input type="file" name="file" id="">
        <span class=" flex gap-2">
        <button class="bg-btn p-2 mt-2 w-full text-white font-bold">Update</button>
    </span>
    </div>

</form>
@endsection