<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold">All Students (Sorted by GPA)</h3>
                        <a href="{{ route('students.create') }}"
                           class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-300">
                            Add New Student
                        </a>
                    </div>

                    @if ($students->isEmpty())
                        <p class="text-gray-600 text-center py-8">No students added yet. Click "Add New Student" to begin!</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider rounded-tl-lg">Student Name</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">GPA</th>
                                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider rounded-tr-lg">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr class="border-b border-gray-200 last:border-b-0 hover:bg-gray-50 transition duration-150">
                                            <td class="py-3 px-4 text-gray-800 font-medium">{{ $student->name }}</td>
                                            <td class="py-3 px-4 text-gray-600">{{ $student->email ?? 'N/A' }}</td>
                                            <td class="py-3 px-4 text-gray-800 font-semibold">{{ number_format($student->gpa, 2) }}</td>
                                            <td class="py-3 px-4 flex space-x-2">
                                                <a href="{{ route('students.edit', $student->id) }}"
                                                   class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300 text-sm">
                                                    Edit
                                                </a>
                                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                                    @csrf
                                                    @method('DELETE') {{-- Laravel's way to simulate DELETE request --}}
                                                    <button type="submit"
                                                            class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-300 text-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>