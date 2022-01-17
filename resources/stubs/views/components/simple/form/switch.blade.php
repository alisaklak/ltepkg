<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" wire:model='model.{{$field['name']}}' id="switch{{$loop->index}}">
        <label class="custom-control-label" for="switch{{$loop->index}}" style="cursor: pointer">{{$field['label']}}</label>
    </div>
    <x-simple.error :name="'model.'.$field['name']" />
</div>