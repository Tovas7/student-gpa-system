<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Student: ' . $student->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('students.update', $student->id) }}">
                @csrf
                @method('PUT') {{-- Use PUT method for updates as per RESTful conventions --}}
                @include('students._form', ['student' => $student, 'courses' => $courses, 'buttonText' => 'Update Student'])
            </form>
        </div>
    </div>
</x-app-layout>