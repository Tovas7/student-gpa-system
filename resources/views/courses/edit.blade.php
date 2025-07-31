<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Course: ' . $course->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('courses.update', $course->id) }}">
                @csrf
                @method('PUT')
                @include('courses._form', ['course' => $course, 'buttonText' => 'Update Course'])
            </form>
        </div>
    </div>
</x-app-layout>