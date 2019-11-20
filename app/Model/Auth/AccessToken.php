<?php

namespace App\Model\Auth;

use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    //
    protected $table = 'oauth_access_tokens';

    public function accessible()
    {
        return $this->hasMany(ClientAccessible::class,'client_id','client_id');
    }
}
