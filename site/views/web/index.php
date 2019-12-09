<?php

use app\site\models\User;

?>

<div class="row">
    <div class="col-md-12">
        <p><a class="btn btn-success" href="/web/create-task">Создать задачу</a></p>
        <br>
        <?php if (!empty($tasks)) : ?>
            <table class="table mb-2">
                <thead>
                <tr>
                    <th scope="col">
                        <a href="<?= $provider->getSortUrlByAttr('title'); ?>" class="fa fa-sort"> Название</a>
                    </th>
                    <th scope="col">
                        <a href="<?= $provider->getSortUrlByAttr('username'); ?>" class="fa fa-sort"> Автор</a>
                    </th>
                    <th scope="col">Описание</th>
                    <th scope="col">
                        <a href="<?= $provider->getSortUrlByAttr('finished'); ?>" class="fa fa-sort"> Статус</a>
                    </th>
                    <th scope="col">Создано</th>
                    <?php if (User::isAdmin()) : ?>
                        <th scope="col">
                            <a href="#">#</a>
                        </th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tasks as $task) : ?>
                    <tr>
                        <td><?= encode($task->title); ?></td>
                        <td><?= encode($task->username) ?></td>
                        <td> <?= encode($task->description) ?></td>
                        <td>
                            <?php if ($task->finished == 1) : ?>
                                <span class="text-success">Выполнено</span>
                                </br>
                                <span class="text-info" style="font-size: 12px">Редактировано админом</span>
                            <?php else : ?>
                                <span class="text-danger">В обработке</span>
                            <?php endif; ?>
                        </td>
                        <td> <?= (new DateTime($task->created_at))->format('H:i:s m.d.Y') ?></td>
                        <?php if (User::isAdmin()) : ?>
                            <th scope="col">
                                <a href="/admin/tasks/update?id=<?= $task->id ?>">
                                    <i class="fa fa-pencil-square" title="Редактировать"></i>
                                </a>
                            </th>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php if ($provider->paginate == true) : ?>
                <?php $defaultPage = (!isset($_GET['page'])) ? 'active' : ''; ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                        $default = '';
                        if (!isset($_GET['page'])) {
                            $default = 'active';
                        } else {
                            if ($_GET['page'] == 1) $default = 'active';
                        }
                        ?>
                        <li class="page-item <?= $default ?>">
                            <a class="page-link" href="<?= $provider->getUrlForNav(1) ?>"> 1 </a>
                        </li>
                        <?php for ($i = 2; $i <= $provider->totalPages; $i++) : ?>
                            <?php $active = (isset($_GET['page']) and $_GET['page'] == $i) ? 'active' : ''; ?>

                            <li class="page-item <?= $active ?>">
                                <a class="page-link active" href="<?= $provider->getUrlForNav($i) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
