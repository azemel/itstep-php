# День 4.

## :house: Домашнее задание

### Задачи

1. Дополнить Ваш файл [`validation.php`](../day-3/validation.php) из третьего ДЗ. Добавить обязательное удаление html тэгов из всех полей
1. В файле [`hw4.php`](./hw4.php) правильно подключить файл `validation.php` и настроить схему валидации так же как в третьем ДЗ.
1. Следуя инструкциям в файле `hw4.php` настроить валидацию реальной html формы.
1. Написать код изменения размера изображения для обложки книги в файле `hw4.php`.  

### На проверку
- Файл `validation.php`
- Файл `hw4.php`

## :tv: [Запись онлайн-занятия](https://zoom.us/rec/share/-OdtP6r-6XJIGdbf52yDSPY-P4X8eaa8higb_KFfxB6jsceoqTzz0tOSGJBSe3lP?startTime=1584622543000)

## :scroll: Конспект

### Подключение дополнительных файлов в текущий скрипт

`include` - если файл не существует, выдается `warning` и работа продолжается,

```PHP
include("filename.php");
```

`require` - если файл не найден, выдаеся `fatal error` и скрипт останавливается

```PHP
require("filename.php");
```

Варианты `_once` подключают файл только один раз, сколько бы не вызывалось его включение 

```PHP
include_once("filename.php");
require_once("filename.php"); 
```

### Суперглобальные переменные

Суперглобальные переменные `$_SERVER`, `$_POST`, `$_GET` и др. доступны из любого контекста (функции, метода) без ключевого слова `global`

### `$_SERVER`

Ассоциативный массив, содержащий смесь информации о сервере и текущем запросе

Посмотрите, что в нем содержится: 
```PHP
var_dump($_SERVER); 
```

Сейчас нам интересно полее `REQUEST_METHOD`. Содержит метод запроса в виде строки `"GET"`, `"POST"` и др.

```PHP
var_dump($_SERVER['REQUEST_METHOD']); 
```

### `$_GET` - Параметры строки запроса (query string)

Ассоциативный массив содержащий параметры из строки запроса

:pencil2: Добавьте в адресной строке `?param1=value1&param2=value2` и посмотрите, что появится в массиве `$_GET`. Например: http://localhost?param1=value1&param2=value2

```PHP
var_dump($_GET); 
```


### `$_POST` - Параметры тела запроса 

Ассоциативный массив содержащий параметры из тела запроса, в случае если `ContentType` запроса `application/x-www-form-urlencoded` или `multipart/form-data`.

Для отправки POST запроса из браузера, необходимо создать форму

```HTML
<form method="post">
  <input name="formParam1"/>
  <button type="submit">Отправить</button>
</form>
```
:pencil2: Отправьте форму и посмотрите, что появится в массиве `$_POST`. 

```PHP
var_dump($_POST);
```

### `$_FILES` -  Загрузка файлов

Ассоциативный массив содержщий информацию о файлах, отправленных в текущем запросе.

Нужно обязательно указать тип данных формы `multipart/form-data`
и добавить поле ввода для файла

```HTML
<form method="post" enctype="multipart/form-data">
  <input name="file" type="file"/>
  <button type="submit">Отправить</button>
</form>
```

:pencil2: Отправьте файл и посмотрите, что появится в массиве `$_FILES`. 

```PHP
var_dump($_FILES);
```

Ключ `tmp_name` содержит путь к временному местонахождению файла  
*Важно*: файлы загружаются в временную папку и удаляются от туда автоматически после того, как скрипт завешит обработку запроса. Если с временным файлом ничего не сделать(напрмиер сохранить или прочитать) до отправки ответа, то он будет потерян. 

Для сохранения файлов используем специльную функцию  
Вторым параметром передаем постоянный путь, где будет хрниться файл после загрузки  
*Важно:* Директория должна существовать или быть созданной до вызова этой функции  
*Важно:* Расширения файла нужно указывать самостояятельно, взяв из названия файла, определив из mime типа или другим способом.

```PHP
move_uploaded_file($_FILES["file"]["tmp_name"], "files/filename.txt");  
```

### Изменение размера загруженного изображения

:warning: Необходимо подключить расширение php GD. См. инструкции во [втором уроке](../day-2/README.md#подключение-расширений-php)

1.  Получаем информацию об изображении. 
    Подробнее о функции `getimagesize`: https://www.php.net/manual/ru/function.getimagesize 
    - 0 - ширина в пикселях
    - 1 - высота в пикселях
    - 2 - формат 

    ```PHP
    $filename = "files/filename.txt";
    $info = getimagesize($filename);
    var_dump($info);

    [$width, $height, $format] = $info;
    ```

    Формат можно сравнивать с константами `IMAGETYPE_*`

    ```PHP
    if ($format === IMAGETYPE_JPEG) {
      var_dump("Это jpeg");
    } else {
      var_dump ("Это не jpeg");
    }
    ```

2.  Определяем новые размер 

    ```PHP
    $newWidth = $width / 2;
    $newHeight = $height / 2;
    ```

3.  Читаем файл изображения специальной функцией, в зависимости от фомата
    ```PHP
    $original = null;
    switch ($info[2]) {
      case IMAGETYPE_JPEG:  $original = imagecreatefromjpeg($filename);  break;
      case IMAGETYPE_PNG:   $original = imagecreatefrompng($filename);  break;
      default: echo var_dump("Не поддерживаемый формат");
    }
    ```
4.  Создаем копию с измененными размерами
    ```PHP
    if ($original) {

      // Создаем пустое изображение нужного размера
      $resized = imagecreatetruecolor($newWidth, $newHeight);
      // Копируем оригинал в новое      
      imagecopyresampled(
        $resized, // куда
        $original, // откуда
        0, 0, // координаты левого верхнего угла в новом изображении (так можно вставить в определенное место)
        0, 0, // координаты левого верхнего угла старого изображении (так можно скопировать только часть)
        $newWidth, $newHeight, // размеры нового изображения
        $width, $height // размеры старого изображения
      );


      // Сохраняем новый файл специальной функцией, в зависимости от фомата 
      switch ($info[2]) {
        case IMAGETYPE_JPEG:  
          $filename .= ".jpg"; $original = imagejpeg($resized, $filename);
          break;
        case IMAGETYPE_PNG:   
          $filename .= ".png"; $original = imagepng($resized, $filename);
          break;
      }
    }
    ```

5.  Измененный файл можно вывести на страницу

    ```HTML+PHP
    <img src="<?=$filename?>"/>
    ```


### Заметки о безопасности

ВСЕ данные приходящие от клиента необходимо проверять на потенциальные угрозы 

1. XSS - межсайтовый скриптинг

    Злоумышленник может ввести в любое поле вредоносный html код, например js-скрипт собирающий cookies пользователей.  
    Если такой ввод не проверить и вывести прямо на страницу, то он сработает автоматически

    - Для большинства полей, в которых по вашему плану не ожидается html кода, нудно отчистить все html теги
    
      ```PHP
      var_dump(strip_tags("<script>alert('Опасность!')</script>"));
      ```

    - Если вы ожидаете получить код - например, у вас блог по программированию и вы показываете примеры - можно использовать преобразование спец символов html. Тогда они будут выводиться, но не будут обрабатываться как управляющие.

      ```PHP
      var_dump(htmlspecialchars("<script>alert('Опасность!')</script>"));
      echo(htmlspecialchars("<script>alert('Опасность!')</script>"));
      ```

2. Загрузка php скриптов

    Не позволяйте загружать .php файлы, или хотябы не сохраняйте их с раcширением `.php`.
    Иначе злоумышленник может загрузить свой скрипт, перейти по ссылке и он выполнится на вашем сервере со всеми правами, доступными PHP.

