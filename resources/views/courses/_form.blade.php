<div class="p-6 bg-white rounded-xl shadow-lg w-full max-w-4xl mx-auto">
    {{-- Course Name --}}
    <div class="mb-6">
        <x-input-label for="name" :value="__('Course Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $course->name ?? '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    {{-- Credits --}}
    <div class="mb-6">
        <x-input-label for="credits" :value="__('Credits')" />
        <x-text-input id="credits" name="credits" type="number" class="mt-1 block w-full" :value="old('credits', $course->credits ?? '3')" required min="1" max="10" />
        <x-input-error class="mt-2" :messages="$errors->get('credits')" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <a href="{{ route('courses.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
            {{ __('Cancel') }}
        </a>
        <x-primary-button>
            {{ $buttonText }}
        </x-primary-button>
    </div>
</div>