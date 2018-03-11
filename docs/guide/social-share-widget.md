Social share widget
===================

## Configuration options

| Option                | Description                                                                               | Type                                                                  | Default                                       |
|-----------------------|-------------------------------------------------------------------------------------------|-----------------------------------------------------------------------|-----------------------------------------------|
|configurator           |ID of component from app config, configuration array or object of configurator             |string|array|ymaker\social\share\configurators\ConfiguratorInterface   |-                                              |
|url                    |Absolute URL to share page                                                                 |string                                                                 |Result of `Url::to('', true)`                  |
|title                  |Title of share page                                                                        |string                                                                 |-                                              |
|description            |Description of share page                                                                  |string                                                                 |-                                              |
|imageUrl               |Absolute URL to image for share page                                                       |string                                                                 |-                                              |
|driverProperties       |Special properties for specific driver                                                     |array                                                                  |-                                              |
|containerOptions       |HTML options for links container tag. If you won't use it - set `tag` option to `false`.   |array                                                                  |`['tag' => 'ul', 'class' => 'social-share']`   |
|linkContainerOptions   |HTML options for link container tag. If you won't use it - set `tag` option to `false`.    |array                                                                  |`['tag' => 'li']`                              |

## Configuration examples

### configurator

```php
'configurator' => 'socialShare', // ID of component from application config
```

```php
'configurator' => \Yii::$app->get('socailShare'), // component instance
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
