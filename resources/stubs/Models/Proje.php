<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proje extends Model
{
    use HasFactory;

    protected $guarded = [];

    const TABLE_FIELDS = [
        [
            'name' => 'id',
        ],
        [
            'name' => 'name',
            'label' => 'Proje Adı',
        ],

    ];

    const INPUT_FIELDS = [
        [
            'name' => 'name',
            'label' => 'Proje Adı',
            'component' => 'input',
            'type' => 'input',
            'rule' => [
                'required',
                'string',
                'min:3',
            ],
        ],

    ];


    const  CHECK_DELETES = [
        'posts',
    ];



    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
