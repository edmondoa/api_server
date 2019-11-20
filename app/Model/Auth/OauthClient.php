<?php

namespace App\Model\Auth;

use Illuminate\Database\Eloquent\Model;

class OauthClient extends Model
{
    //
    public $tables = 'oauth_clients';

    public function accesible()
    {
        return $this->hasMany(ClientAssesible::class);
    }
}
