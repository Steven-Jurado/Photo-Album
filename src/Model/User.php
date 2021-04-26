<?php

namespace Src\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
    
    public static function Register($data)
    {
        $Users = new User();
        $Users->username = trim($data['name']);
        $Users->email = trim($data['email']);
        $Users->password = password_hash(trim($data['password']),PASSWORD_DEFAULT);
        return $Users->save();
    }

}