<div class="input_container">
    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" placeholder="{{ $placeholder ?? '' }}"
        value="{{ old($name, $value ?? '') }}">
    @error($name)
        <p class="error_text">{{ $message }}</p>
    @enderror
</div>
