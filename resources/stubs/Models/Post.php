<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $guarded = [];


    const TABLE_FIELDS = [
        [
            'name' => 'id',
            // 'exlude_sort' => true,
            'exlude_filter' => true,
            
        ],
        [
            'name' => 'title',
            'label' => 'Başlık',
        ],
        [
            'label' => 'User',
            'name' => 'user_id',
            'relation' => [
                'user',
                'name',
                '\\App\\Models\\User',
            ]
        ],

        [
            'label' => 'Proje',
            'name' => 'proje_id',
            'relation' => [
                'proje',
                'name',
                '\\App\\Models\\Proje',
            ]
        ],
        [
            'label' => 'Aktif',
            'name' => 'active',
            'boolean' => true,
            'class' => 'text-center',
        ],
        [
            'label' => 'Tarih',
            'name' => 'tarih',
        ]
    ];

    const INPUT_FIELDS = [
        [
            'name' => 'title',
            'label' => 'Başlık',
            'component' => 'input',
            'type' => 'input',
            'rule' => [
                'required',
                'string',
                'min:3',
            ],
        ],
        [
            'name' => 'body',
            'label' => 'İçerik',
            'component' => 'textarea',
            'rule' => [
                'required',
                'string',
                'min:3',
            ],
        ],

        [
            'name' => 'user_id',
            'label' => 'User',
            'component' => 'select2',
            'rule' => [
                'required',
            ],
            'model' => '\\App\\Models\\User'
        ],

        // [
        //     'name' => 'proje_id',
        //     'label' => 'Proje',
        //     'component' => 'select',
        //     'rule' => [
        //         'required',
        //     ],
        //     'options' => [
        //         [
        //             'id' => 1,
        //             'name' => 'Proje1',
        //         ],
        //         [
        //             'id' => 2,
        //             'name' => 'Proje22',
        //         ],

        //     ],
        // ],

        [
            'name' => 'proje_id',
            'label' => 'Proje',
            'component' => 'select2',
            'rule' => [
                'required',
            ],
            'model' => '\\App\\Models\\Proje'

        ],
        [
            'name' => 'active',
            'label' => 'Aktif',
            'component' => 'switch',
            'rule' => [],
        ],
        [
            'name' => 'tarih',
            'label' => 'Tarih',
            'component' => 'date',
            'format' => 'YYYY-MM-DD HH:mm',
            'rule' => [
                'required',
                'date'
            ],
        ],
    ];





    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function proje()
    {
        return $this->belongsTo(Proje::class);
    }




    protected $casts = [
        'tarih' => 'datetime:Y-m-d H:i'
    ];
}
