<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class DripEmailer extends Model
{
    protected $table = 'trip';

    protected function send(User $user)
    {
        return true;
    }
}
