<fieldset>
    @if(isset($attributes['publicName']))
    <label class="label" for="<?=$name;?>"><?=$attributes['publicName']?></label>
    @endif
    @if(isset($attributes['type']) && $attributes['type'] == 'date')
    <div class="df-datepicker">
        <input class="df-datepicker__body" type="text" name="<?=$name;?>" placeholder="<?=$attributes['placeholder']?>" value="<?=$value;?>"<?=isset($attributes['required']) ? ' required="required"' : '';?>>
    </div>
    @else
    <input class="input" type="<?=isset($attributes['type']) ? $attributes['type'] : 'text'?>" name="<?=$name;?>" placeholder="<?=$attributes['placeholder']?>" value='<?=$value?>'<?=isset($attributes['required']) ? ' required="required"' : '';?>>
    @endif
</fieldset>
