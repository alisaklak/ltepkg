<div class="col">
    <div class="form-group">
        <label>{{!isset($field['label']) ? strtoupper($field['name']) : $field['label']}}</label>
        <select class="form-control form-control-sm" name="filter[{{$field['name']}}]">
            <option value=""></option>
            <option value="1" {{isset(request()->query()['filter'][$field['name']]) &&
                request()->query()['filter'][$field['name']] == 1? 'selected' : ''}}> Evet
            </option>
            <option value="0" {{isset(request()->query()['filter'][$field['name']]) &&
                request()->query()['filter'][$field['name']] == 0? 'selected' : ''}}> Hayır
            </option>
        </select>
    </div>
</div>