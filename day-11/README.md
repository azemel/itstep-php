# День 11.

## :house: Домашнее задание

Одно общее здание будет в [day 15](../day-15)

## :tv: Запись онлайн-занятия
[За 11 день](https://zoom.us/rec/share/tPBIEKjArGxLT4Gc8W7wa6h8PKW9eaa81CQb-KYMmBtNs0ParLWKBnHq3gg3-FP-?startTime=1585839141000)

## :scroll: Конспект

На этом этапе:

1. Добавили модель `Book`. См [Book.php](./Models/Book.php)
1. Изменили экшены контроллеров так, чтобы они принимали не `Context`, а конкретные кусочки информации которые им нужны. См [BooksController.php](./Controllers/BooksController.php), [IndexController.php](./Controllers/IndexController.php) 

1. Создали класс `Injection`, чтобы была возможность эти специфические кусочки информации передавать в экшны (и потэнциально в любые компоненты приложения) . См [Injection.php](./Core/Route.php)

1. Создали класс `Router` который инкапсулирует работу с маршрутами. См [Injection.php](./Core/Injection.php)

1. Изменили класс `App` чтобы он мог работать с dependency injection. См [App.php](./Core/App.php) 


## Reflection

//TBD

