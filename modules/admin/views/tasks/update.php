<div class="row">
    <div class="col-md-8 m-auto">
        <h4>Редактировать задачу 2</h4>
        <hr>
        <form method="post" action="/admin/tasks/update?id=<?= $model->id ?>">
            <div class="form-group">
                <label for="title">Название задачи</label>
                <input type="text" class="form-control" id="title" value="<?= encode($model->title) ?>"
                       placeholder="Введите название для задачи" name="title" required>
                <?php if (isset($model->errors['title'])) : ?>
                    <label id="title-error" class="error" for="title"><?= $model->errors['title'] ?></label>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="description">Описание задачи</label>
                <textarea name="description" class="form-control" id="description" rows="6"
                          required><?= encode($model->description) ?></textarea>
                <?php if (isset($model->errors['description'])) : ?>
                    <label id="description-error" class="error" for="description"><?= encode($model->errors['description']) ?></label>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="checkbox" class="" id="exampleCheck1" name="finished"
                    <?= ($model->finished) ? "checked" : '' ?>>
                <label class="form-check-label" for="exampleCheck1">Задача выполнена</label>
                <?php if (isset($model->errors['finished'])) : ?>
                    <label id="finished-error" class="error" for="email"><?= $model->errors['finished'] ?></label>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary" name="send">Обновить</button>
        </form>
    </div>
</div>
