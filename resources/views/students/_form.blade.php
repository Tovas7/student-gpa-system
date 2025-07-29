@php
    // Helper function to calculate letter grade from score (for initial render)
    function calculateLetterGrade($score) {
        $s = (int)$score;
        if (is_null($score) || $score === '') return '-'; // Handle null or empty string
        if ($s >= 90) return 'A';
        if ($s >= 80) return 'B';
        if ($s >= 70) return 'C';
        if ($s >= 60) return 'D';
        return 'F';
    }
@endphp

<div class="p-6 bg-white rounded-xl shadow-lg w-full max-w-4xl mx-auto">
    {{-- Student Name --}}
    <div class="mb-6">
        <x-input-label for="name" :value="__('Student Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $student->name ?? '')" required autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    {{-- Student Email --}}
    <div class="mb-6">
        <x-input-label for="email" :value="__('Student Email (Optional)')" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $student->email ?? '')" autocomplete="email" />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>

    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Course Scores</h3>

    @if ($courses->isEmpty())
        <p class="text-gray-600 mb-4">No courses available. Please add courses using the database seeder or directly in the database.</p>
    @else
        @foreach ($courses as $index => $course)
            <div class="flex items-end mb-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                <div class="flex-grow grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Course Name (Read-only) --}}
                    <div>
                        <x-input-label for="courses[{{ $index }}][name]" :value="__('Course Name')" />
                        <x-text-input id="courses[{{ $index }}][name]" type="text" class="mt-1 block w-full bg-gray-100 cursor-not-allowed" value="{{ $course->name ?? $course['name'] }}" readonly />
                        {{-- Hidden input for course ID --}}
                        <input type="hidden" name="courses[{{ $index }}][id]" value="{{ $course->id ?? $course['id'] }}">
                    </div>
                    {{-- Score Input --}}
                    <div>
                        <x-input-label for="courses[{{ $index }}][score]" :value="__('Score (0-100)')" />
                        <x-text-input
                            id="courses[{{ $index }}][score]"
                            name="courses[{{ $index }}][score]"
                            type="number"
                            class="mt-1 block w-full"
                            value="{{ old('courses.' . $index . '.score', $course->score ?? $course['score'] ?? '') }}"
                            min="0"
                            max="100"
                            oninput="updateLetterGrade(this, 'letter-grade-{{ $index }}')" {{-- Call JS function on input --}}
                        />
                        <x-input-error class="mt-2" :messages="$errors->get('courses.' . $index . '.score')" />
                    </div>
                    {{-- Letter Grade Display --}}
                    <div>
                        <x-input-label :value="__('Letter Grade')" />
                        <p id="letter-grade-{{ $index }}" class="mt-1 bg-gray-200 text-gray-800 font-semibold py-2 px-3 rounded-lg w-full text-center">
                            {{ calculateLetterGrade(old('courses.' . $index . '.score', $course->score ?? $course['score'] ?? '')) }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <div class="flex items-center justify-end mt-4">
        <a href="{{ route('students.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
            {{ __('Cancel') }}
        </a>
        <x-primary-button>
            {{ $buttonText }}
        </x-primary-button>
    </div>
</div>

{{-- Inline JavaScript for dynamic letter grade update on the client side --}}
<script>
    function calculateLetterGradeJs(score) {
        const s = parseInt(score, 10);
        if (isNaN(s) || score === '') return '-'; // Handle non-numeric or empty input
        if (s >= 90) return 'A';
        if (s >= 80) return 'B';
        if (s >= 70) return 'C';
        if (s >= 60) return 'D';
        return 'F';
    }

    function updateLetterGrade(inputElement, targetId) {
        const score = inputElement.value;
        const letterGradeElement = document.getElementById(targetId);
        if (letterGradeElement) {
            letterGradeElement.textContent = calculateLetterGradeJs(score);
        }
    }
</script>