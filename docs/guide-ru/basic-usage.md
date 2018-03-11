Базовое использование
=====================

## Вызовите виджет в файле представления

```php
<?= \ymaker\social\share\widgets\SocialShare::widget([
    'configurator'  => 'socialShare',
    'url'           => \yii\helpers\Url::to('absolute/route/to/page', true),
    'title'         => 'Title of the page',
    'description'   => 'Description of the page...',
    'imageUrl'      => \yii\helpers\Url::to('absolute/route/to/image.png', true),
]); ?>
```
