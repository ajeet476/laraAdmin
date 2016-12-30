<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Helper\DataViewer;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable, EntrustUserTrait, DataViewer;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'role_id','password', 'remember_token',
    ];
    /**
     * the data that should be visible to Administrator
     * @var array
     */
    public static $columns = [
        'id', 'active',
        'name', 'email',
        'created_at', 'updated_at'
    ];
}
