<div class="form-group {{ $errors->has($field['name']) ? ' has-error' : '' }}">
    <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
    <select name="{{ $field['name'] }}" @if (isset($field['data']) && $field['data'] == 'array') multiple="multiple" @endif
        class="form-select form-control form-control-sm select2-simple {{ Arr::get($field, 'class') }}"
        id="{{ $field['id'] }}">
        @if (isset($field['data']) && $field['data'] != 'array')
            @foreach (Arr::get($field, 'options', []) as $val => $label)
                <option @if (old($field['name'], setting($field['name'])) == $val) selected @endif value="{{ $val }}">{{ $label }}
                </option>
            @endforeach
        @else
            @if (setting(str_replace('[]', '', $field['name'])) != '')
                @php
                    $values = explode(
                        ',',
                        str_replace(['[', ']', '"'], '', setting(str_replace('[]', '', $field['name']))),
                    );
                @endphp
                @foreach ($values as $value)
                    <option value="{{ $value }}" @selected(true)>
                        {{ App\Models\Code::find($value)->name }}
                    </option>
                @endforeach
            @endif
        @endif

    </select>
    @if ($errors->has($field['name']))
        <small class="help-block">{{ $errors->first($field['name']) }}</small>
    @endif
</div>
