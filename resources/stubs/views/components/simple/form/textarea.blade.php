<div class="form-group">
    <label>{{$field['label']}}</label>
    <textarea class="form-control" wire:model='model.{{$field['name']}}' rows="3"></textarea>
    <x-simple.error :name="'model.'.$field['name']"/>
</div>