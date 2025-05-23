@if (isset($field['name']))
    <div class="form-group {{ $errors->has($field['name']) ? 'has-error' : '' }}">
        <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
        <input type="{{ $field['type'] }}" name="{{ $field['name'] }}"
            value="{{ old($field['name'], setting($field['name'])) }}"
            class="form-control form-control-sm {{ Arr::get($field, 'class') }}" id="{{ $field['name'] }}"
            placeholder="{{ $field['label'] }}">

        @if ($errors->has($field['name']))
            <small class="help-block">{{ $errors->first($field['name']) }}</small>
        @endif
    </div>
@endif
