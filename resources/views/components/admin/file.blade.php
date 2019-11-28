<fieldset>
        <label class="label"><?=$attributes['publicName']?></label>
        <div class="file-upload">
            <label>
                <input class="file-upload__input" type="file" name="<?=$name;?>">
                <div class="button button--small file-upload__button">Выбрать фото</div>
            </label>
            <div class="file-upload__name">Файл не выбран</div>
            <a href="#" class="file-upload__remove js-remove-file">
                <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect y="7.27264" width="10.2851" height="1.02851" transform="rotate(-45 0 7.27264)" fill="#002C5F" />
                    <rect x="0.727295" width="10.2851" height="1.02851" transform="rotate(45 0.727295 0)" fill="#002C5F" />
                </svg>
            </a>
        </div>
        <? if($value != '') :?>
        <img src="<?=$value?>" style="max-width: 400px; margin-top: 20px;">
        <? endif; ?>
</fieldset>