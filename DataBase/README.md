# База данных "BoxberryListPoints"
___
### Структура БД 
- БД построенна на PostgreSQL, для MySQL потребуются небольшие правки
- [Визуализация Базы Данных](https://chessterrdev.github.io/BoxberyListPoints/)

### Установка 
#### Через InstallTables.php

* Заполнить данные к БД в файле конфигурации ``BoxberyListPoints/src/Config/Constants.php``
* Запустить файл ``BoxberyListPoints/DataBase/InstallTables/InstallTables.php``

#### Через PgAdmin или другой сервис администрирования 
```
Используйте дамп DataBase/InstallTables/TableList.sql
```

### Заполнение базы данных через консоль
Заполнение и обновление данных работает с использованием мультипроцессинга, [подробнее о нем тут.](./FillTables#readme)
* Заполнить данные к БД в файле конфигурации ``BoxberyListPoints/src/Config/Constants.php``
* Единственные неизменяемые данные в БД, это список стран и их коды. Нужно проверить чтобы они уже были в БД, 
если их нет, добавить через скрипт ``DataBase/InstallTables/addCountry.php`` или вручную:
  * 643 – Россия,
  * 398 – Казахстан,
  * 112 – Беларусь,
  * 417 - Киргизия
  * 051 - Армения
* Запустить в консоле скрипт BoxberyListPoints/DataBase/FillTables/FillTablesFromConsole.php


### Обновление базы данных через консоль
Заполнение и обновление данных работает с использованием мультипроцессинга, [подробнее о нем тут.](./FillTables#readme)
* Заполнить данные к БД в файле конфигурации ``BoxberyListPoints/src/Config/Constants.php``
* Предпологается что в БД есть список городов и их коды.
* Запустить в консоле скрипт ``BoxberyListPoints/DataBase/FillTables/UpdateTablesFromConcole.php``

### Обновление базы данных по событию CRON 
``Повестить на CRON скрипт BoxberyListPoints/DataBase/FillTables/UpdateTablesFromConcole.php``

Рекомендую ставить запуск скрипта на время штиля, например 12 часов ночи, 1-2 раза в неделю. 