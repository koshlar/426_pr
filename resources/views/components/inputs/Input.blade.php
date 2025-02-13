@component('components.inputs.InputContainer', ['name' => $name])
    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" placeholder="{{ $placeholder ?? '' }}"
        value="{{ old($name, $value ?? '') }}">
@endcomponent
