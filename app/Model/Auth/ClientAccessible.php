<?php

namespace App\Model\Auth;

use Illuminate\Database\Eloquent\Model;

class ClientAccessible extends Model
{
    //
    protected $table = 'clients_accessibles';
    protected $fillable = ['client_id', 'model'];

    public static function check($class){
        return  \Auth::user()->oauthclient[0]->accessible()->where('model',$class)->count();
    }
}
