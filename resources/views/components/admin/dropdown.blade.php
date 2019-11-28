<fieldset>
    <label class="label" for="{{ $name }}">{{ $attributes['publicName'] }}</label>
    <select class="select df-select" name="{{ $name }}">
        @if(is_null($value))
            <option>{{ 'Выберите ' . mb_strtolower(isset($attributes['placeholder']) ? $attributes['placeholder'] : $attributes['publicName']) }}</option>
        @endif
        @foreach($attributes['values'] as $key => $val)
            <option value="{{ $key }}" {{ $key === $value ? 'selected' : '' }}>{{ $val }}</option>
        @endforeach
    </select>
</fieldset>
