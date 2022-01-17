<div>


    {{-- {{$model_name}} --}}


    <x-simple.modal id="Modal{{$model_name}}" :modalsize="' modal-lg '">


        @foreach ($input_fields as $field)

        <x-dynamic-component :component="'simple.form.'.$field['component']" :field="$field" :loop="$loop"
            :model="$model" />
        @endforeach

        <x-slot name="buttons">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Vazgeç</button>
            <button class="btn btn-sm btn-dark" wire:click.prevent="save">Kaydet</button>
        </x-slot>
    </x-simple.modal>

    
    {{-- <pre>
        @php
            print_r($model);
            print_r($input_fields);
        @endphp
    </pre> --}}

</div>




@push('js')
<script>
    function create()
        {
            Livewire.emit('rest');
            $("#Modal{{$model_name}}").modal("show");
        }
        function edit(id)
        {
            Livewire.emit('edit',id);
            $("#Modal{{$model_name}}").modal("show");

        }

        $("#Modal{{$model_name}}").on('hide.bs.modal', function () {
            Livewire.emit('rest');
        });

        function sil(id) {
            Swal.fire({
                    title: 'Kayıt silinecek işlem geri alınamaz',
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        denyButton: 'ml-3 btn btn-secondary'
                    },
                    buttonsStyling: false,
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: '<i class="fas fa-trash    "></i> Sil',
                    denyButtonText: 'vazgeç',
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Livewire.emit('delete',id);
                        // Swal.fire('Saved!', '', 'success')
                    } 
                })
        }

        window.addEventListener('deleteError', event => {
            Swal.fire('Bu kayıtla ilişkiki kayıtlar olduğu için silinemedi', '', 'error')
        });


</script>

<script>

</script>
@endpush








@if ($hasSelect2)
@push('css')
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
@endpush

@push('pluginjs')

<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
@endpush

<script>
    document.addEventListener('livewire:load', function () {

        $('.simpledate').each(function (index, element) {
            $(this).datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
                sideBySide: true
            });
            $('.simpledate').on("change.datetimepicker", function (e){
            model = $(this).data('model');
            @this.set(model, $(this).val());
            });
        });
    });
        
</script>

@endif


@if ($hasSelect2)
@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush
@push('pluginjs')
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
@endpush

@push('js')
<script>
    $("#Modal{{$model_name}}").on('hide.bs.modal', function () {
            $('.simple-select2').each(function (index, element) {
            $(this).val("");
            $(this).trigger('change');
            });
        });

    window.addEventListener('select2', event => {
        $('.simple-select2').each(function (index, element) {
            // element == this
            model=$(this).data('model');
            $(this).val(@this.get(model));
            $(this).trigger('change');
        });
    });

     $(document).ready(function () {
        $('.simple-select2').select2({
            placeholder: "Select",
            // allowClear: true,
            dropdownParent: $('#Modal{{$model_name}}')
        });
        $('.simple-select2').on('change', function (e) {
            data = $(this).select2("val");
            model = $(this).data('model');
            @this.set(model, data);
        });
    });
</script>

@endpush
@endif