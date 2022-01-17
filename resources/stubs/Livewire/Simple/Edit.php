<?php

namespace App\Http\Livewire\Simple;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Edit extends Component
{


    public $model_id = null;
    public $model = [];
    public $model_class;
    public $model_name;
    public $input_fields = [];
    public $url;
    public $hasSelect2 = false;
    public $hasDate = false;


    


    protected $listeners = ['edit', 'rest', 'delete'];




    public function mount($model_name, $url)
    {
        $this->url = $url;
        if (!array_key_exists($model_name, config('simple.models'))) {
            abort(404, 'nonono');
        }
        $this->$model_name = $model_name;
        $this->model_class = '\\App\\Models\\' . $model_name;
        // dd($this->model::all());
        $this->rest();
    }



    public function save()
    {
        $rules = [];
        $attr = [];
        $bcrypts = [];
        $unique_suffix = $this->model_id  ? ',' . $this->model_id : '';
        foreach ($this->input_fields as $field) {
            $rules['model.' . $field['name']] = (!$this->model_id && isset($field['create_rule'])) ? $field['create_rule'] : $field['rule'];

            if (isset($field['unique_table'])) {
                $rules['model.' . $field['name']][] =  'unique:' . $field['unique_table'] . ',' . $field['name'] . $unique_suffix;
            }
            if (isset($field['bcrypt'])) {
                $bcrypts[] = $field['name'];
            }
            $attr['model.' . $field['name']] = $field['label'];
        }



        $this->validate($rules, [], $attr);


        if (count($bcrypts) > 0) {
            foreach ($bcrypts as $value) {
                if (isset($this->model[$value]) && $this->model[$value] != "") {
                    $this->model[$value] = bcrypt($this->model[$value]);
                }
            }
        }



        if ($this->model_id) {
            $this->model_class::find($this->model_id)->update($this->model);
        } else {
            $this->model_class::create($this->model);
        }
        $this->route();
    }

    public function route()
    {
        return redirect($this->url);
    }


    public function rest()
    {
        $this->model_id = null;
        $this->model = [];
        $this->input_fields = [];
        $this->input_fields = $this->model_class::INPUT_FIELDS;

        foreach ($this->input_fields as $field) {
            if ($field['component'] == 'select2') {
                $this->hasSelect2 = true;
            }

            if ($field['component'] == 'date') {
                $this->hasDate= true;
            }
        }
        $this->resetValidation();
    }

    public function delete($id)
    {
        $model = $this->model_class::find($id);
        $canDelete = true;
        if (defined($this->model_class.'::CHECK_DELETES') && count($this->model_class::CHECK_DELETES) > 0) {
            foreach ($this->model_class::CHECK_DELETES  as $relation) {
                if ($model->{$relation}()->exists()) {
                    $canDelete = false;
                }
            }
        }
        if ($canDelete) {
            $model->delete();
            $this->route();
        } else {
            $this->dispatchBrowserEvent('deleteError');
        }
    }


    public function edit($id)
    {
        $this->resetValidation();
        $this->model_id = $id;
        $this->model = $this->model_class::find($id)->toArray();
        $this->dispatch();
    }

    public function dispatch()
    {
        if ($this->hasSelect2) {
            $this->dispatchBrowserEvent('select2');
        }
        if ($this->hasSelect2) {
            $this->dispatchBrowserEvent('date');
        }
    }





    public function render()
    {
        return view('livewire.simple.edit');
    }
}
