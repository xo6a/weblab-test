# Weblab test

Решение тестового задания от компании **"Weblab Technology"** на должность "разработчик php".

## Версия

1.0.0

2017-10-23

## Update

## Технические требования

* php 5.6+
* composer
    * fxp/composer-asset-plugin 1.3.1+
* yii2 framework

## Установка

* Установите composer
* Установите пакет "fxp/composer-asset-plugin"
```
composer global require "fxp/composer-asset-plugin:^1.3.1"
```
* Разверните проект из git репозитория
```
https://github.com/xo6a/weblab-test.git
```
* Из корня проекта запустите утановку через composer
```
composer install
```

## Структура проекта

Помими файлов из базового пакета **YII2 basic** были добавлены и модифицированы следующие файлы (указаны только важные изменения, остальное можно посмотреть в логе git):

```
components/
    exceptions/
        ApiException.php - класс исключения собственного API сервиса
    managers/
        ShamanProxyUserManager.php - класс по управлению сущностью ShamanProxyUser
    services/
        BasicProxyService.php - базовый сервис для доступа к сторонему API
        LocalProxyService.php - сервис по работе с собственным API сервисом
        ShamanProxyService.php - сервис по работе с API Shaman
config/
    main.php - добавление сервисов в локатор
controllers
    ApiController.php - API контроллер
    SiteController.php - WEB контроллер
models
    LoginForm.php - форма авторизации
    ShamanProxyUser - прокси пользователь от API шамана
views
    layouts
        main.php - основной WEB шаблон
views
    site
        index.php - шаблон страницы авторизации
        user.php - шаблон страницы авторизована пользователя
widgets
    views
        shamanProxyUserWidget.php - шаблон виджета прокси пользователей шамана
    ShamanProxyUserWidget.php - виджет вывода пользователя
```

## Схема работы приложения

* Заполняя форму авторизации, пользователь отправляет запрос на бекенд
* На бекенде отпралвяется curl запрос на собственное API
* Собственное API проксирует запрос на API шамана
* Полученные данные выводятся на странице
* Присутствует валидация данных на этапе заполнения формы
* Все ошибки как собственного API так и API шамана перехватываются и выводятся над формой авторизации

## Точка входа

Единственная точка входа
```
web/index.php
```

## Запуск приложения

Откройте в браузере сайт:
```
<domain>
```
или
```
<domain>/index.php
```

Заполните поля тестовыми данными

* email => test@user.demo
* password => 1234567A
* curlname => web-2015

Нажмите кнопку "Вход"

## Автор

* **Летуев Василий**

### Контакты

* Телефон: +79630268663
* Skype: letuyev
* Вконтакте: Василий Летуев
* Почта: xo6a@mail.ru
