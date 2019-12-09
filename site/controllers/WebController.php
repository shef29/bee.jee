<?php

namespace app\site\controllers;

use app\site\models\LoginForm;
use app\site\models\RegistrationForm;
use app\site\models\Task;
use app\site\models\TaskForm;
use app\site\models\TaskSearch;
use app\vendor\mvc\controllers\MainController;
use app\vendor\mvc\models\Alert;
use app\vendor\mvc\models\Auth;

class WebController extends MainController
{
    public function index()
    {
        $provider = new TaskSearch(Task::class, ['limit' => 3, 'defaultSort' => 'id desc']);
        $tasks = $provider->findResult($_GET);

        return $this->render('index', ['tasks' => $tasks, 'provider' => $provider]);
    }

    public function createTask()
    {
        $model = new TaskForm();
        if ($model->postAttributes() && $model->save()) {
            Alert::add('ok', 'Новая задача успешно создана');
            return goHome();
        }
        return $this->render('create-task', ['model' => $model]);
    }

    public function login()
    {
        if (!Auth::isGuest()) goHome();

        $model = new LoginForm;
        if (isset($_POST['send']) and $model->postAttributes() && $model->login()) {
            goHome();
        }

        return $this->render('login', ['model' => $model]);
    }

    public function registration()
    {
        if (!Auth::isGuest()) goHome();

        $model = new RegistrationForm();
        if ($model->postAttributes() && $model->registration()) {
            Alert::add('ok', 'Вы успешно зарегистрировались.');
            return goHome();
        }

        return $this->render('registration', ['model' => $model]);
    }

    public function logout()
    {
        if (Auth::isGuest()) {
            return toLogin();
        }
        Auth::logout();
        return toLogin();
    }

    public function error()
    {
        return $this->render('404');
    }

}