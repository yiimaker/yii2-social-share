L’installation
==============

## Un package d’iInstallation

Le moyen préférable pour installer cette extension c’est d’utiliser le [composer](http://getcomposer.org/download/).

Exécutez une commande

```
$ composer require yiimaker/yii2-social-share
```

ou ajoutez

```
"yiimaker/yii2-social-share": "~1.0"
````

pour la section `require` de votre `composer.json` file.

## La configuration de l’application

Pour utiliser cette extension juste ajoutez le code suivant dans votre configuration de l’application:

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