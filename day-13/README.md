
# День 13.

## :house: Домашнее задание

Одно общее здание будет в [day 15](../day-15)

## :tv: Запись онлайн-занятия
[За 13 день](https://zoom.us/rec/share/_8VeM4ru32FITJ3RxmbFW_MwN7r4T6a81nQf8vYNmkoJc9JsPUWgXTWeO2iJbqjB?startTime=1586266930000)

## :scroll: Конспект

На этом этапе:

1. Добавили класс `View`, который может загружать шаблон html-страницы и заполнять его нужными данными из контроллера. См [View.php](./Core/View.php)

1. Изменили экшены контроллеров чтоб они возрвщали View. См [BooksController.php](./Controllers/BooksController.php), [IndexController.php](./Controllers/IndexController.php)

1. Добавили `Layout`, partial темплейт `Navigation` и два view. См папку [Views](./Views)
 
1. Создали класс `Injection`, чтобы была возможность эти специфические кусочки информации передавать в экшны (и потэнциально в любые компоненты приложения) . См [Injection.php](./Core/Route.php)

1. Изменили класс `App` чтобы он мог работать с views. В частности, помести в `Context` методы для работы с url. См [App.php](./Core/App.php) 

