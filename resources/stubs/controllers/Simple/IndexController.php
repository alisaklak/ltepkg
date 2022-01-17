<?php

namespace App\Http\Controllers\Simple;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;


class IndexController extends Controller
{


    public function index($model_name)
    {
        if (!array_key_exists($model_name, config('simple.models'))) {
            abort(404, 'nonono');
        }
        $model = '\\App\\Models\\' . $model_name;
        $simple['table_fields'] = $model::TABLE_FIELDS;
        $relations = [];
        $allowedFilters = [];
        $allowedSorts = [];
        foreach ($simple['table_fields'] as $field) {
            if (isset($field['relation'])) {
                $relations[] = $field['relation'][0];
            }
            if (!isset($field['exlude_filter'])) {
                if (isset($field['boolean']) || isset($field['relation'])) {
                    $allowedFilters[] = AllowedFilter::exact($field['name']);
                } else {
                    $allowedFilters[] = $field['name'];
                }
            }
            if (!isset($field['exlude_sort'])) {
                $allowedSorts[] = $field['name'];
            }
        }
        // $datas = $model::with($relations)->get();
        // dd($relations);
        $datas = QueryBuilder::for($model)
            ->with($relations)
            ->allowedFilters($allowedFilters)
            ->allowedSorts($allowedSorts)
            // ->paginate(1)
            // ->appends(request()->query());
            ->get();



        return view('simple.index', compact('datas', 'simple', 'model_name', 'allowedFilters', 'allowedSorts'));
    }
}
