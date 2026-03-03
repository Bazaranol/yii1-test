Тестовое задание: каталог книг (Yii1)

Роли:
- guest – просмотр, подписка на автора, просмотр отчёта
- user – CRUD книг и авторов

Авторизация:
- /index.php?r=site/login
- /index.php?r=site/logout

Отчёт:
- /index.php?r=report/topAuthors&year=2024

SMS:
ключ задаётся в protected/config/main.php
params['smspilotKey']

Подписка:
гость может подписаться на конкретного автора.
Уведомления отправляются при создании книги.