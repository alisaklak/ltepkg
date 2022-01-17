<div class="col">
    <div class="form-group">
        <label>{{!isset($field['label']) ? strtoupper($field['name']) : $field['label']}}</label>
        <select class="form-control form-control-sm" name="filter[{{$field['name']}}]">
            <option value=""></option>
            @forelse ($field['relation'][2]::all() as $option)
            <option value="{{$option['id']}}" {{isset(request()->query()['filter'][$field['name']]) &&
                request()->query()['filter'][$field['name']]== $option['id']? 'selected' : ''}}>{{$option['name']}}
            </option>
            @empty
            @endforelse
        </select>
    </div>
</div>