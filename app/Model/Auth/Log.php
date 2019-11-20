<?php

namespace App\Model\Auth;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'user_id', 'model'
    ];
    //public $timestamps = false;
    //
    public static function log($attr){
       
        $log = new Log;
        $log->user_id = $attr['user_id'];
        $log->model = $attr['model'];
        $log->save();
    }
}
