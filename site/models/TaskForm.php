<?php


namespace app\site\models;


use app\vendor\mvc\models\Auth;
use app\vendor\mvc\models\Validator;

class TaskForm
{
    use LoadPost;

    public $email;
    public $title;
    public $username;
    public $description;
    public $errors;

    public function validate()
    {
        $valid = new Validator(get_object_vars($this));

        if (Auth::isGuest()) {
            $valid->checkInput('email')->required()->email()->string();
            $valid->checkInput('username')->required()->string();
        }
        $valid->checkInput('title')->required()->string();
        $valid->checkInput('description')->required()->string();

        if (!empty($valid->hasErrors)) {
            $this->errors = $valid->hasErrors;
            return false;
        }
        return true;
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $task = new Task();
        if (!Auth::isGuest()) {
            $task->id_user = Auth::id();
            $task->username = Auth::user()['username'];
            $task->email = Auth::user()['email'];
        } else {
            $task->email = $this->email;
            $task->username = $this->username;
        }

        $task->title = $this->title;
        $task->description = $this->description;

        return $task->save(false);
    }
}