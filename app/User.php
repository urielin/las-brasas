<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use Notifiable;
    public $timestamps=false;
    protected $table='dbsys.usuarios';
    protected $fillable = [ 'usuario', 'pass', 'paterno','materno','nombres','cargo','admin','pda_key' ];
    public function getAuthPassword()
    {
        return $this->pass;
    }
    protected $hidden = [
        'pass',
    ];
}
