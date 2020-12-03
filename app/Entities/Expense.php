<?php

namespace App\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Expense extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    public $timestamps  = true;
    protected $table    = 'expenses';
    protected $fillable = ['user_id','description','date','image','value'];
}
