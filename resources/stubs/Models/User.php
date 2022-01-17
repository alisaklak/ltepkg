<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
    ];


    const TABLE_FIELDS = [
        ['name' => 'id',],
        ['name' => 'name',],
        ['name' => 'email',],
        [
            'label' => 'Admin',
            'name' => 'admin',
            'boolean' => true,
            'class'=>'text-center',
        ],
    ];

    const INPUT_FIELDS = [
        [
            'name' => 'name',
            'label' => 'İsim',
            'component' => 'input',
            'type' => 'text',
            'rule' => [
                'required',
                'string',
                'min:3',
            ],

        ],
        [
            'name' => 'email',
            'label' => 'E-posta',
            'component' => 'input',
            'type' => 'email',
            'rule' => [
                'required',
                'email',
                'min:3',
            ],
            'unique_table' => 'users'
        ],
        [
            'name' => 'password',
            'label' => 'Parola',
            'component' => 'input',
            'type' => 'password',
            'bcrypt' => true,
            'create_rule' => [
                'required',
                'min:3',
            ],
            'rule' => [
                'nullable',
                'min:3',
            ],

        ],
        [
            'name' => 'admin',
            'label' => 'Admin',
            'component' => 'switch',
            'rule' => [],
        ],
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    const  CHECK_DELETES = [
        'posts',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }



    

}
