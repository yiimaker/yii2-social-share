Installation
============

## Getting Composer package

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ composer require yiimaker/yii2-social-share
```

or add

```
"yiimaker/yii2-social-share": "~2.3"
````

to the `require` section of your `composer.json`.

## Configuring application

To use this extension, simply add the following code in your application configuration:

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
