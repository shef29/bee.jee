<?php
session_start();
require(__DIR__ . '/../config/helpFunctions.php');
require_once __DIR__ . "/../vendor/autoload.php";
$config = require(__DIR__ . '/../config/config.php');

$app = (new \app\vendor\mvc\Application($config));

# ================================================

use app\vendor\mvc\models\Alert;
use app\vendor\mvc\models\Auth;

# ================================================

$content = $app->getContentPage();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/web/create-task">Создать задачу <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <?php if (Auth::isGuest()) : ?>
            <a href="/web/login">Войти</a>
        <?php else : ?>
            <span class="text-white mr-5">( <?= Auth::user()['email'] ?> )</span>
            <a href="/web/logout">Выйти</a>
        <?php endif; ?>
    </div>
</nav>

<main role="main" class="container">
    <?php if (Alert::has('ok')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= Alert::get('ok') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <?php if (Alert::has('bad')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= Alert::get('bad') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <!-- Блок с контентом -->
    <?= $content ?>
</main>

<!--===============================================================================================-->

<script src="/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="/vendor/bootstrap/js/popper.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/js/jquery.validate.js"></script>
<script src="/js/loc/<?= $_COOKIE['local'] ?>.js"></script>
<script src="/js/validate.js"></script>

</body>
</html>