L’utilisation de base
=====================

## Appelez le widget dans le fichier affiché

```php
<?= \ymaker\social\share\widgets\SocialShare::widget([
    'configuratorId' => 'socialShare',
    'url'            => \yii\helpers\Url::to('absolute/route/to/page', true),
    'title'          => 'Title of the page',
    'description'    => 'Description of the page...',
    'imageUrl'       => \yii\helpers\Url::to('absolute/route/to/image.png', true),
]); ?>
```
