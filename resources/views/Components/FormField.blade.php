@props([
'id',
'label',
'type' => 'text',
'name',
'value' => '',
'placeholder' => '',
'required' => false,
'options' => [],
])

<div class="form-field">
    <label for="{{ $id }}" class="form-field-label">{{ $label }}</label>

    @if ($type === 'select')
    <select id="{{ $id }}" name="{{ $name }}" class="form-field-select" @if($required) required @endif>
        @foreach ($options as $option)
        <option value="{{ $option['value'] }}" @if(old($name, $value)==$option['value']) selected @endif>
            {{ $option['label'] }}
        </option>
        @endforeach
    </select>
    @elseif ($type === 'textarea')
    <textarea id="{{ $id }}" name="{{ $name }}" class="form-field-textarea" placeholder="{{ $placeholder }}" @if($required) required @endif>{{ old($name, $value) }}</textarea>
    @elseif ($type === 'checkbox')
    <div class="custom-checkbox-container">
        <input type="checkbox" id="{{ $id }}" name="{{ $name }}" class="custom-checkbox-input" {{ old($name, $value) ? 'checked' : '' }} @if($required) required @endif>
        <label for="{{ $id }}" class="custom-checkbox-label">{{ $label }}</label>
    </div>
    @elseif ($type === 'date')
    <input type="date" id="{{ $id }}" name="{{ $name }}" class="form-field-date" value="{{ old($name, $value) }}" @if($required) required @endif />
    @else
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" class="form-field-input" value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}" @if($required) required @endif />
    @endif
</div>