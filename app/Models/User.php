<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends BaseModel
{
    protected $table            = 'users';
    protected $allowedFields    = ['id','username','password','email','role','created_at'];

    
}
