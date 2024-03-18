@extends('dash')
@section('content')
<form action="{{route('create')}}" method="POST">
    @csrf
    <div class="flex flex-col shadow-sm sm:rounded-lg py-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <input type="text" required class="p-2 text-2xl" name="title" id="" placeholder="Title">
        <textarea required class="mt-2 p-2 text-2xl h-52" placeholder="Decription" name="description" id="" cols="30" rows="10"></textarea>
        <button class="bg-btn p-2 mt-2 text-white font-bold">ADD TASK</button>
    </div>

</form>
@endsection