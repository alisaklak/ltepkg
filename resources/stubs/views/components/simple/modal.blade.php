<!-- Modal -->
<div wire:ignore.self class="modal fade"  {{ $attributes}} tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog {{$modalsize ?? ''}}" role="document">
        <div class="modal-content">
            <div class="modal-body">
                {{$slot}}
            </div>
            <div class="modal-footer">
                {{ $buttons }}
            </div>
        </div>
    </div>
</div>