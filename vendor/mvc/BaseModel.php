<?php


namespace app\vendor\mvc;

use ActiveRecord\Model;


class BaseModel extends Model
{

    public static function findOne($param)
    {
        if (is_array($param)) {
            return self::find('first', $param);
        }
        return self::find('first', ['id' => (int)$param]);
    }

}