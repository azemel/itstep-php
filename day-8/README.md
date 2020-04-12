
# День 8.

## :house: Домашнее задание

Одно общее здание будет в [day 15](../day-15)

## :tv: Запись онлайн-занятия 
[За 10 день](https://zoom.us/rec/share/uJNNL6vKxHxOZ5Xwq3rxGYw8NaL8eaa8hyAb-PYFzhvVcVuruEg35BfCqqFRoOnr?startTime=1585748922000)

Я немного изменил порядок, чтобы сделать процесс более понятным

## :scroll: Конспект

На этом этапе:

1. Настроили перенаправление запросов на `index.php`. См [.htaccess](./.htaccess)

1. Настроили autoload. Для класса `pd\some\namespace\Class` подключается файл `/some/namespace/Class.php`. См [autoload.php](./autoload.php)

1. Настроили обработку ошибок и исключений в классе `App` и общие страницы ошибок. См [App.php](./Core/App.php), [.htaccess](./.htaccess)

1. Создали клас ``Environemnt, в котором можно хранить связанные с окружением настройки. Например, режим разработки и продакшна. На основании этих настроек мы, например, решаем как обрабатывать ошибки.  См [Environement.php](./Core/Environment.php), [App.php](./Core/App.php).

1. Создали класс `Request`, который будет оберткй для всех данных полученных в запросе.
См [Request.php](./Core/Request.php).

1. Сделали простейщий роутинг на основании сравнения uri запроса. См [App.php](./Core/App.php).

