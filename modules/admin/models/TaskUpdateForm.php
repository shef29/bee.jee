<?php

namespace app\modules\admin\models;

use app\site\models\LoadPost;
use app\vendor\mvc\models\Validator;

class TaskUpdateForm
{
    use LoadPost;

    public $title;
    public $description;
    public $finished;

    public $errors;

    public function __construct($model)
    {
        $this->title = $model->title;
        $this->description = $model->description;
        $this->finished = $model->finished;
    }

    public function validate()
    {
        $valid = new Validator(get_object_vars($this));

        $valid->checkInput('title')->required()->string();
        $valid->checkInput('description')->required()->string();
        $valid->checkInput('finished')->boolean();

        if (!empty($valid->hasErrors)) {
            $this->errors = $valid->hasErrors;
            return false;
        }
        return true;
    }

    public function update($model)
    {
        $this->finished = (isset($_POST['finished'])) ? 1 : 0;
        if (!$this->validate()) {
            return false;
        }
        $model->title = $this->title;
        $model->description = $this->description;
        $model->finished = $this->finished;

        return $model->save(false);
    }
}