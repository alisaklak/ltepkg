<div class="col">
    <div class="form-group">
        <label for="">{{!isset($field['label']) ? strtoupper($field['name']) : $field['label']}}</label>
        <input type="text" class="form-control form-control-sm" value="{{request()->query()['filter'][$field['name']] ?? ''}}" name="filter[{{$field['name']}}]" />
    </div>
</div>