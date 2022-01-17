<div class="form-group">
    <label>{{$field['label']}}</label>
    <select class="form-control {{$classes ?? ''}}" wire:model='model.{{$field['name']}}' wire:keydown.enter='save'>
        <option value="">Seç</option>

        @php
        $options = isset($field['model']) ? $field['model']::get()->toArray() : $field['options']
        @endphp
        @foreach ($options as $option)
        <option value="{{$option['id']}}">{{$option['name']}}</option>
        @endforeach
    </select>
    <x-simple.error :name="'model.'.$field['name']" />

</div>