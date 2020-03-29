# День 1. 

## :house: Домашнее задание

### Задачи 

1.  Установить `Apace` и `PHP` следуюя инструкции.

### На проверку:

- Скриншот браузера со страинцей http://localhost

---

## :scroll: Конспект

### Apache сервер

1.  Скачиваем c https://www.apachelounge.com/download/ файл Apache 2.4 Win64

1.  Распковываем папку Apache24 на диск C:/.  
    *Можно установить в любое другое место. В таком случае далее заменяйте `C:/Apache24` на путь к директории, где вы распаковали Apache*

1.  В папке `C:/Apache24/conf` находим файл `httpd.conf`, открываем в редакторе. 
    Проверяем, что путь к серевру указан верно:

    ```aconf
    Define SRVROOT "с:/Apache24"
    ServerRoot "${SRVROOT}"
    ```

1.  Открываем командную строку и выполняем команду запуска сервера

    ```bat
    C:/Apace24/bin/httpd
    ```

    :warning: Если возникает ошибка - занят порт: could not bind to address, 
    то в конфигурационном файл `httpd.conf` меням порт на 8080:
    ```aconf
    Listen 8080
    ```

1.  Переходим в браузере по адресу http://localhost или http://localhost:8080, если меняли порт.  
    Должна отобразиться страница `It works!`

### PHP

1.  Скачиваем с https://windows.php.net/download/ файл *Zip VC15 x64 Thread Safe**  
    :warning: Важно скачать именно Tread Safe, иначе невозможно связать Apache и PHP

1.  Распаковываем в папку `C:/php7`  
    *Можно установить в любое другое место. В таком случае далее заменяйте `C:/php7` на путь к директории, где вы распаковали PHP*

1.  В папке `C:/php7` находим файл `php.ini-development`, копируем его и переименовываем копию в `php.ini`

1.  В конфигурационном файле сервера `httpd.conf` подключаем модуль PHP. Добавляем строки:

    ```aconf
    # Загрузка модуля
    LoadModule php7_module C:/php7/php7apache2_4.dll
    
    # Корневая директория PHP c файлом php.ii
    PHPIniDir "C:/php7"
    ```

1.  В конфигурационном файле сервера `httpd.conf` настраиваем обработку .php файлов. Добавляем строки:
    
    ```aconfi
    AddHandler application/x-httpd-php .php
    ```

1.  В конфигурационном файле сервера `httpd.conf` настраиваем выдачу index.php при обращении к папке. Находим и заменяем строки:

    ```aconf
    <IfModule dir_module>
      DirectoryIndex index.php index.html
    </IfModule>
    ```

1.  Перезапускаем сервер
    ```bat
    C:/Apace24/bin/httpd
    ```

1.  В папке `htdocs` внутри сервера `C:/Apache24` находим файл `index.html`, переименовываем в `index.php`.

1.  Открываем index.php в редакторе и заменяем его содержимое на 
    ```HTML+PHP
    <?php phpinfo(); ?>
    ```

1.  Переходим в браузере по адресу http://localhost или http://localhost:8080, если меняли порт. Должна отобразиться страница с конфигурацией PHP

### Подключение Apache как сервиса

1.  Регистрируем сервис. В командной сторке выполняем команду:
    ```bat
    C:/Apache24/httpd.exe -k install
    ```

1.  В папке `C:/Apache24/bin` находим `ApacheMonitor.exe` и запускаем. 
    Иконка должна появиться в трее. Теперь можно запускать, останавливать и перезапускать Apache через графический интерфейс.

### Настройка виртуальных хостов

1.  В корне сервера `C:/Apache24` создаем папку www.
    В ней создаем папку `itstep`

1.  Создаем там (в `C:/Apache24/www/itstep`) файл `index.php` c любым содержимым.
    Например: 
    ```HTML+PHP 
    <?php phpinfo(); ?>
    ```

1.  Открываем в редакторе файл `C:\Windows\System32\drivers\etc\hosts`.
    Добавляем строку:

    ```hosts
    127.0.0.1       itstep.test
    ```

    :warning: Убежадаемся, что файл сохранился. Разрешаем использовать прова администратора, если система их запрашивает

1.  В конфигурационном файле сервера httpd.conf настраиваем вирутальный хост. Добавляем строки:
    
    ```aconf
    # Порт должен совпадать с тем, что указан в Listen
    <VirtualHost 127.0.0.1:8080>
      # Виртуальное доменное имя
      ServerName itstep.test
      # Путь к корневой папке сайта
      DocumentRoot "${SRVROOT}/www/itstep"
      # Настройка корневой папки сайтом
      <Directory ${SRVROOT}/www/itstep>
          AllowOverride All
          Options Indexes
          Require all granted
      </Directory>
      # Путь для лог-файла сайта
      ErrorLog "logs/itstep.log"
    </VirtualHost>
    ```

1.  Перзапускаем сервер

1.  Открываем в браузере http://itstep.test или http://istep.test:8080, есди меняли порт
    Должна отобразиться страница c содержимым файла `index.php`

