Social share виджет
===================

## Опции для настройки

| Опция             | Описание                                      | Тип данных    | Стандартное значение                  |
|-------------------|-----------------------------------------------|---------------|---------------------------------------|
|configuratorId     |ID конфигуратора из конфигурации приложения    |string         |-                                      |
|url                |Абсолютная ссылка страницы                     |string         |Результат работы `Url::to('', true)`   |
|title              |Заголовок страницы                             |string         |-                                      |
|description        |Описание страницы                              |string         |-                                      |
|imageUrl           |Абсолютная ссылка изображения для страницы     |string         |-                                      |
|driverProperties   |Специальные свойства для конкрутного драйвера  |array          |-                                      |
|wrapperTag         |Имя HTML тега для обёртки всех ссылок          |string         |ul                                     |
|wrapperOptions     |HTML аттрибуты для тега-обёртки                |array          |`['class' => 'social-share']`          |
|linkWrapperTag     |Имя HTML тега для обёртки одной ссылки         |bool/string    |li                                     |
|linkWrapperOptions |HTML аттрибуты для тега-обёртки ссылки         |array          |-                                      |


## Примеры конфигурации

### configuratorId

```php
'configuratorId' => 'socialShare', // ID компонента из конфигурации приложения
```

```php
'configuratorId' => \Yii::$app->get('socailShare'), // экземпляр компонента
```

### driverProperties

```php
'driverProperties' => [
    \ymaker\social\share\drivers\Twitter::class => [
        'account' => 'yiimaker'
    ],
    \ymaker\social\share\drivers\Tumblr::class => [
        'shareUrl' => \common\helpers\UrlHelper::gallaryPageUrl(),
        'tags' => ['apartments', 'planning'],
    ],
],
```