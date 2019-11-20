<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['item', 'user_id', 'done', 'completed_on'];

    protected $casts = ['done' => 'bool', "user_id" => 'int'];

    protected $dates = ['completed_on'];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function checkAccessible()
    {
       return  \Auth::user()->oauthclient[0]->accessible()->where('model','Todo')->count();
    }
}
