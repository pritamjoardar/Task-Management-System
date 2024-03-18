@extends('dash')
@section('content')
<div class="max-w-7xl mx-auto py-2 sm:px-6 lg:px-8">
   <a href="/create"><button class="bg-btn text-white p-1 rounded-md">Create +</button></a>
    </div>
    @if (count($tasks) == 0)
    <h1 class="flex justify-center mt-5">Create a new Task <a href="/create" class="ml-2 text-btn underline">create</a></h1>
    @endif
    @foreach($tasks as $task)
    <div class="mb-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                <div class="flex justify-between">
                <h1 class="text-2xl font-bold">{{$task->title}}</h1>
                <span class="flex justify-between gap-9">
                    <h1 class="flex text-btn {{ $task->assign ? '' : 'hidden' }}">Assign from :
                    <p class="text-delete">{{$task->assign}}</p></h1>
                    <p>{{$task->created_at}}</p>
                    <p>{{$task->status}}</p>
                </span>
                </div>
                <span class="flex justify-between">
                    <p>{{$task->description}}</p>
                    <span class="flex gap-2">
                        <a href="/update/{{$task->id}}"><button class="bg-update  px-2 h-min">UPDATE</button></a>
                        <a href="/delete/{{$task->id}}"><button class="bg-delete px-2 text-white h-min">DELETE</button></a>
                        <a href="/assignTask/{{$task->id}}"><button class="bg-btn px-2 text-white h-min">ASSIGN</button></a>
                    </span>
                </span>
            </div>
        </div>
    </div>
    
@endforeach

<div>{{$tasks->links()}}</div>
@endsection
