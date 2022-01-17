<div class="form-group" wire:ignore>
    <label>{{$field['label']}}</label>
    <input type="text" data-toggle="datetimepicker"
    autocomplete="off"  class="form-control {{$classes ?? ''}} simpledate datetimepicker-input" wire:model='model.{{$field['name']}}' wire:keydown.enter='save' data-format='{{$field['format']}}' data-model='model.{{$field['name']}}'>
    <x-simple.error :name="'model.'.$field['name']"/>
</div>