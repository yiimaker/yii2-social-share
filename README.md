Widget for sharing to social networks
=====================================
With this widget you can to share data from your web pages to any social network!


[![Total Downloads](https://poser.pugx.org/yiimaker/yii2-social-share/downloads)](https://packagist.org/packages/yiimaker/yii2-social-share)
[![Latest Stable Version](https://poser.pugx.org/yiimaker/yii2-social-share/v/stable)](https://packagist.org/packages/yiimaker/yii2-social-share)
[![Latest Unstable Version](https://poser.pugx.org/yiimaker/yii2-social-share/v/unstable)](https://packagist.org/packages/yiimaker/yii2-social-share)

Installation
------------
#### Install package
Run command
```
composer require yiimaker/yii2-social-share
```
or add
```json
"yiimaker/yii2-social-share": "dev-master"
```
to the require section of your composer.json.

Usage
-----
1) Configure drivers for social networks in app config
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
            'class' => 'social-network'
        ],
    ],
],
```

2) Call widget in view file
```php
\ymaker\social\share\widgets\SocialShare::widget([
    'configuratorId' => 'socialShare',
    'url'            => \yii\helpers\Url::to('absolute/route/to/page', true),
    'title'          => 'Title of the page',
    'description'    => 'Description of the page...',
    'imageUrl'       => \yii\helpers\Url::to('absolute/route/to/image.png', true),
]);
```

License
-------
[![License](https://poser.pugx.org/yiimaker/yii2-social-share/license)](https://packagist.org/packages/yiimaker/yii2-social-share)

This project is released under the terms of the BSD-3-Clause [license](https://github.com/yii2deman/yii2-shop/blob/master/LICENSE)

Copyright (c) 2017, Yii Maker
