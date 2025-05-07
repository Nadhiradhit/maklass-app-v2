@props([
    'type' => 'text',
    'id' => '',
    'name' => '',
    'label' => '',
    'placeholder' => '',
    'value'=> '',
    'hasToggle' => false,
])

<div class="mb-3 sm:mb-4">
    @if ($label)
        <label for="{{ $id }}" class="block text-lg font-semibold text-neutral-900 mb-2">{{ $label }}</label>
    @endif

    <div class="{{ $hasToggle ? 'relative' : ' ' }}">
        <input
            type="{{ $type }}"
            id="{{ $id }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            value="{{ $value }}"
            {{ $attributes->merge(['class' => 'w-full bg-neutral-200 rounded-lg p-3'. ($hasToggle ? ' pr-10' : '')]) }}
        >

        @if ($hasToggle && $type === 'password')
        <button type="button" id="toggle_{{ $id }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-neutral-600 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" id="eye_{{ $id }}" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" id="eyeSlash_{{ $id }}" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            </svg>
        </button>
        @endif
    </div>

    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

@if ($hasToggle && $type === 'password')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('{{ $id }}');
            const togglePassword = document.getElementById('toggle_{{ $id }}');

            if (togglePassword && password) {
                const eyeIcon = document.getElementById('eye_{{ $id }}');
                const eyeSlashIcon = document.getElementById('eyeSlash_{{ $id }}');

                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);

                    eyeIcon.classList.toggle('hidden');
                    eyeSlashIcon.classList.toggle('hidden');
                });
            }
        });
    </script>
@endif

