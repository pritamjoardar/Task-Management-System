<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@extends('dash')
@section('content')
<div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
    <div class="flex  justify-between">
        <div class="flex gap-1">
    <form action="" >
        <input  type="search" name="search" class="w-[400px]" placeholder="search by name/descriptin/status" id="">
        <button class="bg-btn p-2 text-white">Search</button>
    </form>
    <a href="{{route('dashboard')}}"><button class="bg-delete p-2 text-white">Reset</button></a>  
</div>
<span class="flex gap-2">
@if($role==="admin")
<a href={{route('admin')}} class="bg-progress h-min text-white font bold px-2 py-1">Admin Dashboard</a>
@endif
    <p class="text-white px-2 py-1 justify-end rounded-full font-bold bg-btn h-min">{{$authemail}}</p>
</span>
</div>
   <a href="/create"><button class="bg-btn text-white p-1 rounded-md">Create +</button></a>
    </div>
    @if (count($tasks) == 0 && count($assignedTasks) == 0)
    <h1 class="flex justify-center mt-5">Create a new Task <a href="/create" class="ml-2 text-btn underline">create</a></h1>
    @endif
{{-- for assign task --}}
@foreach($assignedTasks as $task)
<p>{{$task->category}}</p>
<div class="mb-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
            <div class="flex justify-between">
            <h1 class="text-2xl font-bold">{{$task->title}}</h1>
            <span class="flex justify-between gap-9">         
                @if($authemail!=$task->assignto)                       
                <h1 class="flex text-btn {{ $task->assignto ? '' : 'hidden' }}">Assign to :<p class="text-delete">{{$task->assignto }}</p></h1>
                @endif
            @if($authemail!=$task->assignfrom)
            <h1 class="flex text-btn {{ $task->assignfrom ? '' : 'hidden' }}">Assign from :
                <p class="text-delete">{{$task->assignfrom}}</p>
            </h1> 
            @endif            
            <p>{{$task->created_at}}</p>
            <p class="font-bold text-delete">{{$task->category}}</p>
                @if($task->status=='pending')
                <p class="text-delete font-bold">{{$task->status}}</p>
                @endif
                @if($task->status=='in progress')
                <p class="text-progress font-bold">{{$task->status}}</p>
                @endif                   
                @if($task->status=='completed')
                <p class="text-btn font-bold">{{$task->status}}</p>
                @endif  
            </span>
            </div>
            <span class="flex justify-between mb-3">
                <p>{{$task->description}}</p>
                
                <span class="flex gap-2">
                    <a href="/assignTask/{{$task->id}}"><button class="bg-btn px-2 text-white h-min">ASSIGN</button></a>
                    <a href="/update/{{$task->id}}"><button class="bg-progress text-white  px-2 h-min">UPDATE</button></a>
                    <a href="/delete/{{$task->id}}" id="aaa"><button class="bg-delete px-2 text-white h-min" onclick="conformation(event)">DELETE</button></a>
                </span>
            </span>
            <a href="{{$task->file}}" class="bg-gray-400 p-2 flex items-center rounded-full w-min {{ $task->file ? '' : 'hidden' }}" download="true">{{$task->file}}
            <svg class="w-8 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
        </a>
            {{-- <img class="w-[400px] h-[400px]  {{ $task->file ? '' : 'hidden' }}" src="{{asset($task->file )}}" alt=""> --}}

                <h1 class="bg-dar text-white p-2 mt-5 rounded-md flex justify-center {{ $task->comments ?'hidden' :''}}">No comment <p>{{$task->comments}}</p><a href="/update/{{$task->id}}" class="text-btn underline ml-2">Add comment</a></h1>
            <h1 class="bg-dar text-btn p-2 mt-5 rounded-md {{ $task->comments ? '' :'hidden'}}">{{$task->commentsby}} -> {{$task->commentstime}}<p class="text-white">{{$task->comments}}</p></h1>
        </div>
    </div>
</div>
@endforeach


    {{-- for all task --}}
    @foreach($tasks as $task)
    <div class="mb-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                <div class="flex justify-between">
                <h1 class="text-2xl font-bold">{{$task->title}}</h1>
                <span class="flex justify-between gap-9">         
                    @if($task->email!=$task->assignto)                       
                    <h1 class="flex text-btn {{ $task->assignto ? '' : 'hidden' }}">Assign to :<p class="text-delete">{{$task->assignto }}</p></h1>
                    @endif
                @if($task->email!=$task->assignfrom)
                <h1 class="flex text-btn {{ $task->assignfrom ? '' : 'hidden' }}">Assign from :
                    <p class="text-delete">{{$task->assignfrom}}</p>
                </h1> 
                @endif
                
                    <p>{{$task->created_at}}</p>
                    <p class="font-bold text-delete">{{$task->category}}</p>
                    @if($task->status=='pending')
                    <p class="text-delete font-bold">{{$task->status}}</p>
                    @endif
                    @if($task->status=='in progress')
                    <p class="text-progress font-bold">{{$task->status}}</p>
                    @endif                   
                    @if($task->status=='completed')
                    <p class="text-btn font-bold">{{$task->status}}</p>
                    @endif  
                </span>
                </div>
                <span class="flex justify-between mb-3">
                    <p>{{$task->description}}</p>
                    <span class="flex gap-2">
                        <a href="/assignTask/{{$task->id}}"><button class="bg-btn px-2 text-white h-min">ASSIGN</button></a>
                        <a href="/update/{{$task->id}}"><button class="bg-progress text-white  px-2 h-min">UPDATE</button></a>
                        <a href="/delete/{{$task->id}}" id="aaa"><button class="bg-delete px-2 text-white h-min" onclick="conformation(event)">DELETE</button></a>
                    </span>
                </span>
                <a href="{{$task->file}}" class="bg-gray-400 p-2 flex items-center rounded-full w-min {{ $task->file ? '' : 'hidden' }}" download="true">{{$task->file}}
                <svg class="w-8 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
            </a>
                {{-- <img class="w-[400px] h-[400px]  {{ $task->file ? '' : 'hidden' }}" src="{{asset($task->file )}}" alt=""> --}}

                    <h1 class="bg-dar text-white p-2 mt-5 rounded-md flex justify-center {{ $task->comments ?'hidden' :''}}">No comment <p>{{$task->comments}}</p><a href="/update/{{$task->id}}" class="text-btn underline ml-2">Add comment</a></h1>
                <h1 class="bg-dar text-btn p-2 mt-5 rounded-md {{ $task->comments ? '' :'hidden'}}">{{$task->commentsby}} -> {{$task->commentstime}}<p class="text-white">{{$task->comments}}</p></h1>
            </div>
        </div>
    </div>
@endforeach


<div>{{$tasks->links()}}</div>
@endsection
<script>
    function conformation(event){
        event.preventDefault();
       let url = document.getElementById("aaa").getAttribute("href"); 
       swal({
        title:"Are you sure you want to delete the task ?",
        text:"you won't be able to revert the changes",
        icon:'warning',
        buttons:true,
        dangerMode:true,
 
       }).then((willcancel)=>{
        if(willcancel){
            if(willcancel){
                window.location.href = url;
            }
        }
       })
        
    }
</script>