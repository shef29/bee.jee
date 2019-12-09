<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\TaskUpdateForm;
use app\site\models\Task;
use app\site\models\User;
use app\vendor\mvc\controllers\MainController;
use app\vendor\mvc\models\Alert;
use app\vendor\mvc\models\Auth;

class TasksController extends MainController
{
    public function __construct()
    {
        if (Auth::isGuest()) return toLogin();
        if (!User::isAdmin()) return pageNotFount();
    }

    public function update()
    {
        $id = (isset($_GET['id'])) ? $_GET['id'] : null;
        if ($id == null) {
            return pageNotFount();
        }
        if (($task = Task::findOne($id)) == null) {
            return pageNotFount();
        }
        $model = new TaskUpdateForm($task);
        if ($model->postAttributes() and $model->update($task)) {
            Alert::add('ok', 'Задача успешно обновлена');
            return goHome();
        }

        return $this->render('update', ['model' => $task]);
    }
}