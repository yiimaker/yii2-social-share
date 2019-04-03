Social share виджет
===================

## Опции для настройки

| Опция                 | Описание                                                                                                                                              | Тип данных    | Стандартное значение                          |
|-----------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------|---------------|-----------------------------------------------|
|configurator           |ID конфигуратора из конфигурации приложения, массив с настройками или объект конфигуратора                                                             |string         |-                                              |
|url                    |Абсолютная ссылка страницы                                                                                                                             |string         |Результат работы `Url::to('', true)`           |
|title                  |Заголовок страницы                                                                                                                                     |string         |-                                              |
|description            |Описание страницы                                                                                                                                      |string         |-                                              |
|imageUrl               |Абсолютная ссылка изображения для страницы                                                                                                             |string         |-                                              |
|driverProperties       |Специальные свойства для конкретного драйвера                                                                                                          |array          |-                                              |
|containerOptions       |HTML аттрибуты для тега, который оборачивает все ссылки. Если вы не хотите использовать этот тег - установите елемент массива `tag` в значение `false` |array          |`['tag' => 'ul', 'class' => 'social-share']`   |
|linkContainerOptions   |HTML аттрибуты для тега, который оборачивает одну сслку. Если вы не хотите использовать этот тег - установите елемент массива `tag` в значение `false` |array          |`['tag' => 'li']`                              |


## Примеры конфигурации

### configurator

```php
'configurator' => 'socialShare', // ID компонента из конфигурации приложения
```

```php
'configurator' => \Yii::$app->get('socailShare'), // экземпляр компонента
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
