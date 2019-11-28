<label class="checkbox">
    <input type="checkbox" name="{{ $name }}" id="{{ $attributes['id'] }}" {{ $value > 0 ? 'checked' : '' }} {!! isset($attributes['value']) ? 'value="' . $attributes['value'] . '"' : '' !!}" >
    <div class="checkbox__box"></div>
    <div class="checkbox__title">{{ $attributes['publicName'] }}</div>
</label>