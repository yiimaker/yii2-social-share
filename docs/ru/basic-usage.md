Базовое использование
=====================
Если вы хотите использовать все возможности - прочтите [продвинутуе использование](advanced-usage.md).

Настройка драйверов социальных сетей в конфигурации приложения
--------------------------------------------------------------

```php
'components' => [
    // ...
    'socialShare' => [
        'class' => \ymaker\social\share\configurators\Configurator::class,
        'socialNetworks' => [
            'facebook' => [
                'class' => \ymaker\social\share\drivers\Facebook::class,
                'label' => Yii::t('app', 'Facebook'),
                'options' => ['class' => 'fb'],
            ],
            'twitter' => [
                'class' => \ymaker\social\share\drivers\Twitter::class,
                'label' => Yii::t('app', 'Twitter'),
                'options' => ['class' => 'tw'],
                'config' => [
                    'account' => $params['twitterAccount']
                ],
            ],
            'googlePlus' => [
                'class' => \ymaker\social\share\drivers\GooglePlus::class,
                'label' => Yii::t('app', '+Google'),
                'options' => ['class' => 'gp'],
            ],
            // ...
        ],
        'options' => [
            'class' => 'social-network',
        ],
    ],
],
```

Вызов виджета в файле вида
--------------------------

```php
<?= \ymaker\social\share\widgets\SocialShare::widget([
    'configuratorId' => 'socialShare',
    'url'            => \yii\helpers\Url::to('absolute/route/to/page', true),
    'title'          => 'Title of the page',
    'description'    => 'Description of the page...',
    'imageUrl'       => \yii\helpers\Url::to('absolute/route/to/image.png', true),
]); ?>
```