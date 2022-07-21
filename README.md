# Boxberry List Points
Это реализация [этого алгоритма](https://help.boxberry.ru/pages/viewpage.action?pageId=1703951) 
т.е. пакет реализует локальное хранилище всех ПВЗ boxberry и информации о них. 


### Требования и зависимости:
* PHP 8
* PDO PostgreSQL (apt-get install php-pgsql)
* CURL
* symfony/process версии 5.4 и выше

## Установка и заполнение (обновление) базы данных
ВНИМАНИЕ! Заполнение БД реализованно через использование консольного мультипроцессорного запуска скриптов.
* [Подробнее о заполнении Базы данных](./DataBase/README.md).
* [Визуализация Базы Данных (Диаграмма)](https://chessterrdev.github.io/BoxberyListPoints/)
* [Мультипроцессорное заполнение БД](./DataBase/FillTables#readme)

## Поиск ПВЗ 
Весь список примеров лежит в папке 'Examples'. 
Каждый метод поиска возвращает массив со всеми найденными ПВЗ. Каждый элемент массива это объект класса
``BoxberryListPoints\Models\ListPoints``, он включает в себя всю информацию о ПВЗ. 
Каждое свойство объекта имеет свой get'ер. 
### Поиск по id 
Возвращает объект ListPoints
```php
use \BoxberryListPoints\Controllers\ListPointShort;
$listPoints = ListPointShort::findPointShortById(1692);
```
### Поиск по Code ПВЗ
Возвращает массив объектов ListPoints
```php
$listPoints = ListPointShort::findPointShortByCode('19908');
```
### Поиск по ZipCode
Возвращает массив объектов ListPoints
```php
$listPoints = ListPointShort::findPointShortByZipCode(101000)
```
### Поиск по полному адресу
Возвращает массив объектов ListPoints
```php
$listPoints = ListPointShort::findPointShortByAddress('Москва', 'Октябрьская'));

$listPoints = ListPointShort::findPointShortByAddress(
    'Москва',
    'Октябрьская', // Street
    5, // House
    5, // Structure
    5, // Housing
    5 // Apartment
);
```
### Поиск по названию города
```php
$listPoints = ListPointShort::findPointShortByCityName('Москва')
```
### Поиск по населенному пункту
```php
$listPoints = ListPointShort::findPointShortBySettlement('Кумертау')
```

### Полный список всех get'еров модели ListPoints
``BoxberryListPoints\Models\ListPoints``
```php
$listPoint->getId();
$listPoint->getCode();
$listPoint->getTerminalCode();
$listPoint->getName();
$listPoint->getOrganization();
$listPoint->getZipCode();
$listPoint->getCountryCode();
$listPoint->getPhone();
$listPoint->getUpdateDate();
$listPoint->isActive();
$listPoint->isDeleted();
$listPoint->getPhotos();
$listPoint->getMetro();
$listPoints->Area->getId();
$listPoints->Area->getName();
$listPoints->Area->getCountryCode();
$listPoints->City->getId();
$listPoints->City->getName();
$listPoints->City->getSettlement();
$listPoints->City->getAreaId();
$listPoints->Address->getId();
$listPoints->Address->getCitiesId();
$listPoints->Address->getStreet();
$listPoints->Address->getHouse();
$listPoints->Address->getStructure();
$listPoints->Address->getHousing();
$listPoints->Address->getApartment();
$listPoints->Address->getAddressFull();
$listPoints->Address->getAddressReduce();
$listPoints->Address->getTripDescription();
$listPoints->GPS->getId();
$listPoints->GPS->getLongitude();
$listPoints->GPS->getLatitude();
$listPoints->Properties->getId();
$listPoints->Properties->getForeignOnlineStoresOnly();
$listPoints->Properties->getPrepaidOrdersOnly();
$listPoints->Properties->getAcquiring();
$listPoints->Properties->getDigitalSignature();
$listPoints->Properties->getTypeOfOffice();
$listPoints->Properties->getCourierDelivery();
$listPoints->Properties->getReception();
$listPoints->Properties->getReceptionLaP();
$listPoints->Properties->getDeliveryLaP();
$listPoints->Properties->getLoadLimit();
$listPoints->Properties->getVolumeLimit();
$listPoints->Properties->getEnablePartialDelivery();
$listPoints->Properties->getEnableFitting();
$listPoints->Properties->getFittingType();
$listPoints->Properties->getNalKD();
$listPoints->Properties->getTransType();
$listPoints->Properties->getInterRefunds();
$listPoints->Properties->getExpressReception();
$listPoints->Properties->getTerminal();
$listPoints->Properties->getIssuanceBoxberry();
$listPoints->WorkShedule->getId();
$listPoints->WorkShedule->getShortWorkShedule();
$listPoints->WorkShedule->getWorkMoBegin();
$listPoints->WorkShedule->getWorkMoEnd();
$listPoints->WorkShedule->getWorkTuBegin();
$listPoints->WorkShedule->getWorkTuEnd();
$listPoints->WorkShedule->getWorkWeBegin();
$listPoints->WorkShedule->getWorkWeEnd();
$listPoints->WorkShedule->getWorkThBegin();
$listPoints->WorkShedule->getWorkThEnd();
$listPoints->WorkShedule->getWorkFrBegin();
$listPoints->WorkShedule->getWorkFrEnd();
$listPoints->WorkShedule->getWorkSaBegin();
$listPoints->WorkShedule->getWorkSaEnd();
$listPoints->WorkShedule->getWorkSuBegin();
$listPoints->WorkShedule->getWorkSuEnd();
$listPoints->WorkShedule->getLunchMoBegin();
$listPoints->WorkShedule->getLunchMoEnd();
$listPoints->WorkShedule->getLunchTuBegin();
$listPoints->WorkShedule->getLunchTuEnd();
$listPoints->WorkShedule->getLunchWeBegin();
$listPoints->WorkShedule->getLunchWeEnd();
$listPoints->WorkShedule->getLunchThBegin();
$listPoints->WorkShedule->getLunchThEnd();
$listPoints->WorkShedule->getLunchFrBegin();
$listPoints->WorkShedule->getLunchFrEnd();
$listPoints->WorkShedule->getLunchSaBegin();
$listPoints->WorkShedule->getLunchSaEnd();
$listPoints->WorkShedule->getLunchSuBegin();
$listPoints->WorkShedule->getLunchSuEnd();
$listPoints->WorkShedule->getScheduleJSON();
```