# День 16-19

## :house: Домашнее задание

В наш существующий [laravel-проект](https://github.com/azemel/itstep-laravel) добавить возможность для владельцев книги "забирать" ее обратно.  Для этого:
1. Добавить в `web.php` маршрут для этого действия `book/{book}/retrieve`
1. В `BookPolicy` добавить политику `retrieve` которая будет разрешать это действие только владельцам книги
1. Создать и примнеть миграцию, которая добавить `integer` поле `status` в таблицу `Books`
1. Во вью шаблоне `book.blade.php` выводить поле `status`. 
1. Если статус "Неактивна" - НЕ показывать действия связанные с очередью и саму очередь
1. Если статус "Активна" - то показывать для владельца кнопку "Забрать обратно", отправляющую на `book/{book}/retrieve`.
1. Добавить в контроллер `BooksController` экшн `retrieve`. В нем
    1. Проверить иммет ли пользователь право с помощью `Gate`
    1. Поменять статус книги на "Неактивна"
    1. [Необязателньое ] Достать всех ожидающих в очереди пользователей и отравить им email о том, что хозяин забрал книгу
1. [Необязателньо] Реализовать обратное действие для владельца "вернуть" книгу в систему.

## :tv: Запись онлайн-занятия
[За 20 день](https://zoom.us/rec/share/po9WE_Kz2HNOfonm8ljgaKgHA4_Xaaa80HVMr_AJmkg6P6H8PyrjrKiqPLwt7Pnt?startTime=1587389355000)

За 21 день. [Часть 1](https://zoom.us/rec/share/7-AqP6H5_zpOS43_wk3yYpINLKTuaaa82ykc_PVcmU95rKTLEGe5LV3AMHwWhuNS?startTime=1587475436000).
[Часть 2](https://zoom.us/rec/share/7-AqP6H5_zpOS43_wk3yYpINLKTuaaa82ykc_PVcmU95rKTLEGe5LV3AMHwWhuNS?startTime=1587482327000)

[За 22 день](https://zoom.us/rec/share/osl8LO3B1mROTbPP6ULdSqk8PZy4eaa8hiQarvBZzbO_s1phxuQPThCJW9S_cRU?startTime=1587561926000)

[За 23 день](https://zoom.us/rec/share/wMwraI_R9ENOU9L800D_UY4hEd7GT6a803BN_fQFxB7kFMq6yoqJQ-gCbnImwwhG?startTime=1587648109000)

## :scroll: Конспект

Вторая неделя с Laravel
