<select name="parent_id" class="form-control col-md-7 col-xs-12" multiple size="20" id="template-select">
    <option value="">@lang('admin.product')</option>
    @foreach($templates as $template)
        <option value="{{ $template->id }}" data-level="1">{{ $template->title }}</option>
    @endforeach
</select>
