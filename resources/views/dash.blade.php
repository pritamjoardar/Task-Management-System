<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task Management System') }}
        </h2>
    </x-slot>
    @yield('content')
</x-app-layout>