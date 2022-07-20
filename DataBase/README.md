# База данных "BoxberryListPoints"
___
### Структура БД 
- БД построенна на Постгресс, для MySQL потребуются небольшие правки
- Подробная [Визуализация Базы Данных](https://chessterrdev.github.io/BoxberyListPoints/)

### Установка 
Через InstallTables.php

* Заполнить данные к БД в файле конфигурации BoxberyListPoints/src/Config/Constants.php
* Запустить файл BoxberyListPoints/DataBase/InstallTables/InstallTables.php

Через PgAdmin или другой сервис администрирования 
```
Используйте дамп DataBase/InstallTables/TableList.sql
```

### Заполнение базы данных через консоль
Заполнение и обновление данных работает с использованием мультипроцессинга, [подробнее о нем тут.](./FillTables#readme)
* Заполнить данные к БД в файле конфигурации BoxberyListPoints/src/Config/Constants.php
* Запустить в консоле скрипт BoxberyListPoints/DataBase/FillTables/FillTablesFromConsole.php


### Обновление базы данных через консоль
Заполнение и обновление данных работает с использованием мультипроцессинга, [подробнее о нем тут.](./FillTables#readme)
* Заполнить данные к БД в файле конфигурации BoxberyListPoints/src/Config/Constants.php
* Запустить в консоле скрипт BoxberyListPoints/DataBase/FillTables/UpdateTablesFromConcole.php

### Обновление базы данных по событию CRON 
``Повестить на CRON скрипт BoxberyListPoints/DataBase/FillTables/UpdateTablesFromConcole.php``

Рекомендую ставить запуск скрипта на время штиля, например 12 часов ночи. 