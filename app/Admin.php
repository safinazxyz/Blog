<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class Admin extends Authenticatable
{
    use Notifiable;
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'type',
        'mobile',
        'email',
        'password',
        'image',
        'status',
        'created_at',
        'updated_at'
    ];
    protected $hidden = [
        'password','remember_token'
    ];
}
