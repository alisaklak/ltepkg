<div class="form-group">
    <label>{{$field['label']}}</label>
    <div>
        <div class="select2-wr" data-val="{{ $model[$field['name']] ?? '' }}">
            <div wire:ignore>
                <select class="form-control simple-select2 " data-model="model.{{$field['name']}}"
                    data-val="{{ $model[$field['name']] ?? '' }}">
                    <option value=""></option>
                    @php
                    $options = isset($field['model']) ? $field['model']::get()->toArray() : $field['options']
                    @endphp
                    @foreach ($options as $option)
                    <option value="{{$option['id']}}">{{$option['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <x-simple.error :name="'model.'.$field['name']" />
</div>