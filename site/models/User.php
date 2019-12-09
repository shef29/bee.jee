<?php

namespace app\site\models;

use ActiveRecord\Model;
use app\vendor\mvc\BaseModel;
use app\vendor\mvc\models\Auth;

class User extends BaseModel
{

    public static function findOne($id)
    {
        return self::find('first', ['id' => (int)$id]);
    }

    public static function isAdmin()
    {
        if (Auth::isGuest()) return false;

        if (Auth::user()['role'] == 'admin') {
            return true;
        }
        return false;
    }

    public function generatePass($pass)
    {
        return sha1($pass);
    }

}