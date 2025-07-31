<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('courses.store') }}">
                @csrf
                @include('courses._form', ['buttonText' => 'Create Course'])
            </form>
        </div>
    </div>
</x-app-layout>