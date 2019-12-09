1. Клонировать проект себе или скачать архив.
2. в Директории /config/config.php - настройки для подключение к БД
    'db' => [
        'database' => 'bee_jee',
        'username' => 'root',
        'password' => '',
    ],

3. Страница входа и запуска сайта находится в папке public файл index.php
В этой же папке лежат стили и скрипты, и все остальное.

4. основная часть проекта находится в site
5. Если в проекте есть модули, например админ, то лежит он как раз таки в modules/admin
Чтобы он заработал, нужно его добавить в конфиг  /config/config.php

'modules' => [
        'admin' => [],
    ],

===============================================

6. mvc построена по следующему принцыпу :
    site _
    
          |___ controllers - входят все контроллеры
          
          |___ models - модели проекта
          
          |___ views - шаблоны проекта
          

    При создании контроллера - TestController и метода внутри - helloWorld()
    Ссылка будет строиться http://my.site.com/test/hello-world

    Для того, чтобы подлкючить view, в папке /site/views/ создаем одноименную папку test
    Дальше, создаем файл /site/views/test/hello-world.php

    Файл подключеяется в контроллере с помощью метода $this->render('hello-world');
    
----------------------------------------------------
    
    В модулях все аналогично, только после домена сначала будет ити название модуля
    http://my.site.com/admin/posts/index
    admin - Модуль
    posts - Контроллер
    index - Метод (action)

----------------------------------------------------
login :admin@mail.com
pass : 12344321
