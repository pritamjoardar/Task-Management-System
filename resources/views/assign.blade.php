@extends('dash')
@section('content')
<form class="p-1" action="{{ route('assignTaskUser', ['id' => $assignTask->id, 'title' => $assignTask->title, 'description' => $assignTask->description]) }}"  method="POST" >
    @csrf
    <div class="flex flex-col shadow-sm sm:rounded-lg py-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="font-bold text-2xl mb-3">Task Details: </h1>
        <h1 class="font-bold flex text-xl flex-col md:flex-row" >Title : <p class="font-normal">{{$assignTask->title}}</p></h1>
        <h1 class="font-bold flex text-xl flex-col md:flex-row" >Description : <p class="font-normal">{{$assignTask->description}}</p></h1>
        <h1 class="font-bold flex text-xl" >Status : <p class="font-normal">{{$assignTask->status}}</p></h1>
        <span class="flex gap-2 border mt-2 md:w-96">
            <input class="w-full " required placeholder="Type user email address" type="email" name="email" id="">
            <button class="bg-btn text-white px-4 hidden">Add</button>
        </span>
        <button class="bg-btn p-2 mt-4 text-white font-bold">ASSIGN TASK</button>
    </div>

</form>
@endsection