<?php

namespace app\site\models;


trait LoadPost
{
    public function postAttributes()
    {
        if(isset($_POST['send'])) {
            foreach (get_object_vars($this) as $attribute => $value) {
                if (key_exists($attribute, $_POST)) $this->$attribute = $_POST[$attribute];
            }
            return true;
        }
    }
}