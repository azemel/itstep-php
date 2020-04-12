
# День 10.

## :house: Домашнее задание

Одно общее здание будет в [day 15](../day-15)

## :tv: Запись онлайн-занятия
[За 8 день](https://zoom.us/rec/share/-tUlIqPI7k9OSNbL9n3AdqQbDrX8X6a81iYc_fFZxRvFpncucXfpcema4wfdxeEb?startTime=1585574434000)

[За 9 день](https://zoom.us/rec/share/5f5PJZvdxE5OQY3s7wLZRpQvAIvZX6a80CMd-PsMyR3wbOh3ztP1QQtVmM6STuvp?startTime=1585662802000)

Я немного изменил порядок, чтобы сделать процесс более понятным

## :scroll: Конспект

На этом этапе:

1. Создали класс `Route` для хранения данных о маршруте. Маршрут умеет создавать регулярное выражение на основе полученного шаблона, сравнивать url c этим шаблоном и извлекать параметры маршрута. А также формировать url для маршрута. См [Route.php](./Core/Route.php)

1. Создали класс `Router` который инкапсулирует работу с маршрутами. См [Router.php](./Core/Router.php)

1. Добавили класс `Context` который будет единым местом обмена информацией межжду компонентами приложения. См [Context.php](./Core/Context.php) 

1. Добавили контроллеры c экшнами, который пока принимают `Context`. См [BooksController.php](./Controllers/BooksController.php), [IndexController.php](./Controllers/IndexController.php) 

1. Изменили класс `App` чтобы он мог работать с маршрутами. См [App.php](./Core/App.php) 
