@extends('layouts.app')

@section('content')

<x-content-header :label="config('simple.models.'.$model_name.'.label')" />

<div class="pb-3">
    <div class="btn btn-sm btn-dark btn-filter {{isset(request()->query()['filter']) ? 'd-none' : 'd-inline-block'}}"> <i class="fas fa-search"></i> Filtre</div>
</div>

<div class="card card-filter {{isset(request()->query()['filter']) ? 'd-block' : 'd-none'}}">

    <div class="card-body">
        <form>
        <div class="row">
                @forelse ($simple['table_fields'] as $field)
                @if (!isset($field['exlude_filter']))
                    @if (isset($field['relation']))
                    <x-filter.select :field="$field" />
                    @elseif(isset($field['boolean']))
                    <x-filter.boolean :field="$field" />
                    @else
                    <x-filter.input :field="$field" />
                    @endif
                @endif
                @empty

                @endforelse
            </div>
            <div class="text-center">
                <button class="btn btn-sm btn-dark"><i class="fas fa-search"></i> Filtre</button>
                <a href="{{request()->url()}}" class="btn btn-sm btn-secondary">Temizle</a>
            </div>
        </form>
    </div>
</div>



<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        @foreach ($simple['table_fields'] as $field)
                        <x-filter.th :allowedSorts="$allowedSorts" :field="$field" />
                        {{-- <th>{{ !isset($field['label']) ? strtoupper($field['name']) : $field['label']}}</th> --}}
                        @endforeach
                        <th style="width: 100px"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datas as $data)
                    <tr>
                        @foreach ($simple['table_fields'] as $field)
                        <td class="{{$field['class'] ?? ''}} ">

                            @if (isset($field['relation']))
                            {{ $data->{$field['relation'][0]}->{$field['relation'][1]} }}
                            @elseif(isset($field['boolean']))
                            {!! $data->{$field['name']} ? '<i class="fa fa-check" aria-hidden="true"></i>' : '' !!}
                            @else
                            {{ $data->{$field['name']} }}
                            @endif

                        </td>

                        @endforeach
                        <td>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="javascript:" onclick="edit({{$data->id}})" class="text-dark">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:" onclick="sil({{$data->id}})" class="text-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="100">Data Yok</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-lg-flex justify-content-between">
    <div class="">
        <button class="btn btn-sm btn-dark" onclick="create()">{{$model_name}} Ekle</button>
    </div>
    {{-- {{$datas->links() ?? ''}} --}}
</div>


@livewire('simple.edit', ['model_name' => $model_name , 'url'=>request()->url()])

@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('.btn-filter').click(function (e) { 
                e.preventDefault();
                
                $(this).removeClass('d-inline-block');
                $(this).addClass('d-none');
                $('.card-filter ').addClass('d-block');
            });
        });
    </script>
@endpush