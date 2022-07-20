# Многопроцессорность

Для более бытрого и стабильного обновления (заполнения) БД 
я использую ``Multiprocessing`` мультипроцессорный (множественный) запуск ``worker`` сценариев.

### Функции
* Множественный запуск worker-сценариев
* Автоматическое масштабирование процесса с помощью ``queues``
* ``Pipeline`` обработка с автоматически масштабируемыми шагами
* Неблокирующий ``rate limited queues``
* Упрощенный дочерний скрипт логирования

### Работа
Принцип работы прост, скрипт принимает 2 аргумента, путь к исполняющему скрипту-воркеру,
и массив со списком параметров, для каждого элемента массива запускается свой исполнитель.
#### Инициализация 
```php
use BoxberryListPoints\Libs\MultiProcessing;

$multiProcessing = new MultiProcessing(
        __DIR__ . '/Worker.php', // путь к исполняющему скрипту
        [] // массив со списком запускаемых параметров 
    );
```
#### Установить количество одновременно запущенных процессов
```php
$multiProcessing->setSumOfProcesses(10);
```
#### Добавить callback функцию запускаемую при запуске Воркера
```php
$startCallbackFunction = function ($message) {
    echo "The script is running: $message  \n";
};
$multiProcessing->setStartCallbackFunction($startCallbackFunction);
```
#### Добавить callback функцию запускаемую при завершении работы Воркера
```php
$finishCallbackFunction = function ($message) {
    echo "The script is completed: $message  \n";
};
$multiProcessing->setFinishCallbackFunction($finishCallbackFunction);
```
#### Запустить мультипроцессорную обработку 
```php
$statistics = $multiProcessing->run();
```