<?php

use app\vendor\mvc\models\Lang;

?>

<div class="row">
    <div class="col-md-6 m-auto auth-form">
        <form action="/web/registration" method="post" class="login-form validate-form form-auth"
              enctype="multipart/form-data">
					<span class="login-form-title">
						<?= Lang::t('reg') ?>
            </span>
            <div class="wrap-input100 validate-input">
                <input class="input100" type="text" value="<?= $model->username ?>" name="username"
                       placeholder="<?= Lang::t('username') ?>" required>
                <i class="focus-input100"></i>
                <i class="fa fa-user-circle my-fa"></i>
                <?php if (isset($model->errors['username'])) : ?>
                    <label id="email-error" class="error" for="username"><?= $model->errors['username'] ?></label>
                <?php endif; ?>
            </div>
            <div class="wrap-input100 validate-input">
                <input class="input100" type="email" name="email" value="<?= $model->email ?>"
                       placeholder="<?= Lang::t('email') ?>" required>
                <i class="focus-input100"></i>
                <i class="fa fa-envelope my-fa"></i>
                <?php if (isset($model->errors['email'])) : ?>
                    <label id="email-error" class="error" for="email"><?= $model->errors['email'] ?></label>
                <?php endif; ?>
            </div>
            <div class="wrap-input100 validate-input">
                <input class="input100" id="password" type="password" name="password"
                       placeholder="<?= Lang::t('password') ?>" required>
                <span class="focus-input100"></span>
                <i class="fa fa-lock my-fa"></i>
                <?php if (isset($model->errors['password'])) : ?>
                    <label id="email-error" class="error" for="password"><?= $model->errors['password'] ?></label>
                <?php endif; ?>
            </div>
            <div class="wrap-input100 validate-input">
                <input class="input100" type="password" name="confirm_password" name="pass"
                       placeholder="<?= Lang::t('confirm password') ?>" required>
                <span class="focus-input100"></span>
                <i class="fa fa-lock my-fa"></i>
                <?php if (isset($model->errors['confirm_password'])) : ?>
                    <label id="email-error" class="error"
                           for="confirm_password"><?= $model->errors['confirm_password'] ?></label>
                <?php endif; ?>
            </div>
            <div class="container-login-form-btn">
                <div class="wrap-login-form-btn">
                    <div class="login-form-bgbtn"></div>
                    <button class="login-form-btn" name="send">
                        <?= Lang::t('reg') ?>
                    </button>
                </div>
            </div>
            <div class="sp-nav">
                <div class="tab-enter">
                    <a href="/web/login"><?= Lang::t('login') ?></a>
                </div>
            </div>
        </form>
    </div>
</div>
