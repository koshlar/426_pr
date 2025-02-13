<div class="input_container">
    {{ $slot }}
    @error($name)
        <p class="error_text">{{ $message }}</p>
    @enderror
</div>
