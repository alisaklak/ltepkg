<div class="form-group">
    <label>{{$field['label']}}</label>
    <input type="{{$field['type']}}"  class="form-control {{$classes ?? ''}}" wire:model='model.{{$field['name']}}' wire:keydown.enter='save' >
    <x-simple.error :name="'model.'.$field['name']"/>
</div>