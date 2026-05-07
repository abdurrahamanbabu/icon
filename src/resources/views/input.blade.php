<div class="form-group">
    <label for="">{{ __("common.Icon") }}</label>
    <input value="{{ isset($icon) ? $icon : '' }}" type="text" id="icon" class="form-control icon" data-icon="icon" data-show="#icon-showcase">
    <div id="icon-showcase"></div>
</div>