<p align="center">
  <img alt="avtocod" src="https://avatars1.githubusercontent.com/u/32733112?s=70&v=4" width="70" height="70" />
</p>

# Тестовое задание для PHP-разработчика

[![Version][badge_php_version]][link_packagist]
[![Commits since latest release][badge_commits_since_release]][link_commits]
[![Release date][badge_release_date]][link_releases]
[![Issues][badge_issues]][link_issues]

Необходимо с использованием фреймворка `Laravel` реализовать сервис "Стена сообщений".

## :fire: Как начать выполнять тестовое задание

Решение данного задания рекомендуется размещать на GitHub, но если у вас нет такой возможности - вы можете разместить его на любом другом git-сервисе с публичным доступом.

> **Внимание!** **Не следует** делать "fork" данного репозитория, и возвращать решение в виде PR.

- Создаём репозиторий для решения, [перейдя по данной ссылке](https://github.com/new). В поле "Repository name" вводим `avtocod-php-developer-test-task` и нажимаем "Create repository"

- На локальной машине открываем терминал, и (например) в домашней директории разворачиваем скелетон данного задания, после чего переходим в его директорию:

```bash
$ composer create-project avtocod/avtocod-php-developer-test-task ~/avtocod-php-developer-test-task
$ cd $_
```

> Если в процессе разворачивания возникнут ошибки о том, что в системе не хватает каких-либо библиотек (например - `php-sqlite3`) - вам будет необходимо установить недостающие, после чего повторить выполнение команды `composer create-project ...`

- Убеждаемся в том, что приложение корректно развернулось и готово к использованию:

```bash
$ ./artisan
$ ./artisan migrate:install
```

> При необходимости настраиваем `nginx + php-fpm` - самостоятельно

- Инициализируем git-репозиторий и "подключаем" его к удалённому репозиторию, который был создан на первом шаге:

```bash
$ git init
$ git remote add origin git@github.com:%USERNAME%/avtocod-php-developer-test-task.git
```

- Коммитим и пушим первые изменения:

```bash
$ git add .
$ git commit -m 'Skeleton deployed'
$ git push --set-upstream origin master
```

## Описание необходимого функционала

### Главная страница

Содержит список всех сообщений. Сортировка - снизу-вверх _(последнее добавленное сообщение - сверху)_. У каждого сообщения, помимо текста, указано имя (username) автора и опционально - аватар (используя API сервиса `gravatar`, например).

Если пользователь авторизован, ему становится доступна форма отправки сообщения.

Сообщение не может быть пустым (или состоять только из пробелов). При попытке отправки такого сообщения - пользователю выдается предупреждение "Сообщение не может быть пустым".

После успешной отправки, сообщение пользователя сразу появляется на "стене".

Авторизованный пользователь может также удалять свои сообщения.

### Авторизация

В случае неуспешной авторизации, пользователю выводится сообщение "Вход в систему с указанными данными невозможен".

### Регистрация

Требования к логину и паролю пользователя могут быть следующие:

- Логин - только альфа-символы (`a-z`) (в любом регистре) + возможно цифры (`0-9`), минимальная длинна - 8 символов;
- Пароль - обязательно символы в верхнем и нижнем регистрах + цифры, минимальная длинна - 6 символов.

В случае не успешной регистрации, каждое некорректно заполненное поле должно быть снабжено сообщением об ошибке.

### Главное меню (сверху)

- Пункт “Главная” - ведет на главную страницу, показывается всегда;
- Пункты “Авторизация” и “Регистрация” показываются только не авторизованным пользователям.

Блок справа показывается только авторизованному пользователю. Содержит Имя пользователя и ссылку "Выход", нажав на которую, пользователь выходит из - под своей учетной записи.

> Плюсом будет реализация возможности указания для определенных учётных записей прав "администратора" (`is_admin`), дающие возможность удалять чужие сообщения.

### Вёрстка

HTML-верстка находится в директории `./storage/markup` (bootstrap) - именно её необходимо использовать. Опционально можете сверстать свои представления.

## Требования к используемым технологиям

Задание должно быть:

- Выполнено с использованием PHP фреймворка `Laravel` версии не ниже `5.5`;
- БД - `sqlite3`, `PostgreSQL`;
- Redis, Memcached - опционально, по желанию;

## Требования к реализации

- Разрешено использовать любые сторонние composer-пакеты;
- Все реализуемые методы должны иметь корректный phpdoc-комментарий (описание на русском языке, `@params`, `@return`);
- Для проверки передаваемых приложению по HTTP данных использовать валидацию входящих запросов (`artisan make:request ...`);
- База данных должна создаваться с помощью миграций (никаких sql-файлов);
- База данных должна наполняться фейковыми записями с помощью механизма сидов;
- Для всего реализованного функционала должны быть написаны Unit-тесты (`phpunit`);
- После завершения работы в **данном** readme-файле описать все действия, необходимые для запуска приложения _(текущее содержание можно удалить)_ с опциональными комментариями по решению задания.

## Плюсами будут являться

- Интуитивно-понятное разбитие коммитов - одной конкретной задаче - один коммит (её правки - отдельный коммит);
- Текст коммитов - на английском языке;
- Написание `docker-compose.yml`, который запускает написанное приложение.

## Результат выполнения

Ссылку на репозиторий с вашей реализацией необходимо отправить нашему HR, от которого вы получили ссылку на данный репозиторий.

> Если в процессе выполнения у вас возникнут какие-либо неразрешимые вопросы - создайте [соответствующий issue][link_create_issue] в данном репозитории. На вопросы касательно деталей реализации ("А лучше так и так?") - вероятнее всего вы получите ответ "Как вы посчитаете правильнее".

[badge_php_version]:https://img.shields.io/packagist/php-v/avtocod/avtocod-php-developer-test-task.svg?style=flat-square&longCache=true
[badge_issues]:https://img.shields.io/github/issues/avtocod/avtocod-php-developer-test-task.svg?style=flat-square&maxAge=180
[badge_commits_since_release]:https://img.shields.io/github/commits-since/avtocod/avtocod-php-developer-test-task/latest.svg?style=flat-square&maxAge=180
[badge_release_date]:https://img.shields.io/github/release-date/avtocod/avtocod-php-developer-test-task.svg?style=flat-square&maxAge=180
[link_packagist]:https://packagist.org/packages/avtocod/avtocod-php-developer-test-task
[link_releases]:https://github.com/avtocod/avtocod-php-developer-test-task/releases
[link_commits]:https://github.com/avtocod/avtocod-php-developer-test-task/commits
[link_issues]:https://github.com/avtocod/avtocod-php-developer-test-task/issues
[link_create_issue]:https://github.com/avtocod/avtocod-php-developer-test-task/issues/new