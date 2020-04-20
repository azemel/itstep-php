# День 15

## :house: Домашнее задание

### I. Минимум
1. Добавить валидацию. НЕ через middleware, а обычным способом
    1. Заменить файл [`Validation.php`](./Middlewate/Validation.php) на ваше решение из [hw6](../day-6). 
    1. Удалить регистрацию `Validation` middleaware в `index.php`
        ```PHP
        $app->useMiddleware(new Validation());
        ```
    1. В экшене `save` контроллера [`BooksController`](./Controllers/BooksController.php) добавить проверку Book "на месте" используя вашу валидацию (с теми же правилами)
1. Добавить загрузку файла обложки. Можно снова скопировать эту чать из [hw4](../day-4). НО:
    1. В базу данных в таблице `Books` нужно добавить колонку `Book_Cover` 
    2. Файл мы получаем из аргумента `$files` переданного в экшене (НЕ из `$_FILES`)
    3. Файл нужно сохранить в папку content 
    4. Имя файла должно быть `id` книги в базе данных + расширение (пр. 123.jpg) 
    5. Это имя нужно сохранить в базу данных в поле `Book_Cover`
    6. :thinking: В идеале обработку файла хорошо бы вынести в отедельный класс или хотя бы метод.

### II. Необязателньое задание  
***
:grey_exclamation: Если полностью выполните это задание, то я засчитаю его как экзамен :grey_exclamation:
***

Задача перевести все на middleware.
1. `RoutingMiddleware`.
    1. Регистрация `RoutingMiddleware` с `useMiddleware` должна заменить `useRouter`. Можно изменить класс Router, чтобы он стал работать как middleware. В любом случае маршрутизация должна уйти из Core и из App.
    1. `RoutingMiddleware` должен как и прежде определять маршрут по url и добавлять в `Context` свойство `route`. Так же он должен добавлять в конекст функцию urlToRoute
    1. Используя `Injection` должен определить какие аргументы требуются экшену, приготовить их и добавить в `Context` отдельным массивом `actionArgs`. Также в `Context` помещается сам `ReflectionMedthod` экшена в свойство `action`.
1. `ValidationMiddleware`. 
    1. Используя все ту эе реалзиацию валидации, превратить ее в middleware. 
    1. `ValidationMiddleware` должна проверить все в `actionArgs`. Еси аргумент это модель, проверить есть ли в ней свойство `validatioin` и использовать его как схему валидации. Очищенные значения должны перезаписать то, что есть в модели, а ошибки помещены в массив `errors` в `Context`.
1. В методе `run` в `App` должно остаться только создание `Request` и `Context`, вызов `pipeline` и отправка ответа. Причем вызов экшена в `pipeline` должен теперь исользовать подготовленные аргументы и `ReflectionMethod` из `Context`

## :tv: Запись онлайн-занятия
[За 14 день. 1 часть](https://zoom.us/rec/share/y-VwcfLg8WZLYYXS-mHFYLwZDpXkT6a8gyUdr_sNz09ddgrAIC_ngf1mJJdRxfBW?startTime=1586359477000)

[За 14 день. 2 часть](https://zoom.us/rec/share/y-VwcfLg8WZLYYXS-mHFYLwZDpXkT6a8gyUdr_sNz09ddgrAIC_ngf1mJJdRxfBW?startTime=1586359477000)

Я немного изменил порядок, чтобы сделать процесс более понятным

## :scroll: Конспект

На этом этапе:

1. Добавили в `App` поддержку middleware. См [App.php](./Core/App.php)

1. Для проверки добавили middleware для валидации. См [Validation.php](./Middleware/Validation.php)
