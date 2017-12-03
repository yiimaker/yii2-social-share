L’utilisation de base
=====================
> Si vous voulez utiliser toutes les fonctionnalités – lisez le guide de 
[l’utilisation avancée](advanced-usage.md) et des [trucs et astuces](tips-and-tricks.md).

Configurez les pilotes pour les réseaux sociaux dans l’ app config
------------------------------------------------------------------

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

Appelez le widget dans  le fichier affiché
------------------------------------------

```php
<?= \ymaker\social\share\widgets\SocialShare::widget([
    'configuratorId' => 'socialShare',
    'url'            => \yii\helpers\Url::to('absolute/route/to/page', true),
    'title'          => 'Title of the page',
    'description'    => 'Description of the page...',
    'imageUrl'       => \yii\helpers\Url::to('absolute/route/to/image.png', true),
]); ?>
```
