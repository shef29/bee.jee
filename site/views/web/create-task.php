<?php

use app\vendor\mvc\models\Auth;

?>

<div class="row">
    <div class="col-md-8 m-auto">
        <h4>Создать задачу</h4>
        <hr>
        <form method="post" action="/web/create-task">
            <?php if (Auth::isGuest()) : ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Ваш Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="Введите email" name="email" required>
                    <small id="emailHelp" class="form-text text-muted">Обязательно для ввода</small>
                    <?php if (isset($model->errors['email'])) : ?>
                        <label id="email-error" class="error" for="email"><?= $model->errors['email'] ?></label>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputName">Ваше Имя</label>
                    <input type="text" class="form-control" id="exampleInputName"
                           placeholder="Введите Ваше имя" name="username" required>
                    <small id="emailHelp" class="form-text text-muted">Обязательно для ввода</small>
                    <?php if (isset($model->errors['username'])) : ?>
                        <label id="email-error" class="error" for="email"><?= $model->errors['username'] ?></label>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="exampleInputTitle">Название задачи</label>
                <input type="text" class="form-control" id="exampleInputTitle"
                       placeholder="Введите название для задачи" name="title" required>
                <small id="emailHelp" class="form-text text-muted">Обязательно для ввода</small>
                <?php if (isset($model->errors['title'])) : ?>
                    <label id="email-error" class="error" for="email"><?= $model->errors['title'] ?></label>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="description">Описание задачи</label>
                <textarea name="description" class="form-control" id="description" rows="6" required></textarea>
                <small id="emailHelp" class="form-text text-muted">Обязательно для ввода</small>
                <?php if (isset($model->errors['description'])) : ?>
                    <label id="email-error" class="error" for="email"><?= $model->errors['description'] ?></label>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary" name="send">Создать</button>
        </form>
    </div>
</div>
