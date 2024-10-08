[![Stand With Ukraine](https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/banner-direct.svg)](https://stand-with-ukraine.pp.ua)

<p align="center">
    <a href="https://github.com/yiimaker" target="_blank">
        <img src="https://avatars1.githubusercontent.com/u/24204902" height="100px">
    </a>
    <h1 align="center">Extension for sharing on social networks</h1>
</p>

[![Build Status](https://travis-ci.org/yiimaker/yii2-social-share.svg?branch=master)](https://travis-ci.org/yiimaker/yii2-social-share)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yiimaker/yii2-social-share/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/yiimaker/yii2-social-share/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/yiimaker/yii2-social-share.svg)](https://packagist.org/packages/yiimaker/yii2-social-share)
[![Monthly Downloads](https://img.shields.io/packagist/dm/yiimaker/yii2-social-share.svg)](https://packagist.org/packages/yiimaker/yii2-social-share)
[![Latest Stable Version](https://img.shields.io/packagist/v/yiimaker/yii2-social-share.svg)](https://packagist.org/packages/yiimaker/yii2-social-share)
[![StandWithUkraine](https://raw.githubusercontent.com/vshymanskyy/StandWithUkraine/main/badges/StandWithUkraine.svg)](https://github.com/vshymanskyy/StandWithUkraine/blob/main/docs/README.md)

With this extension you can share data from your web pages to any social network!
Features: SEO support, default icons for social networks, easy creation of custom drivers
for other social networks and more!

Documentation is at [docs/guide/README.md](docs/guide/README.md).

Extension supports from the box next social network drivers:

* [Facebook](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/Facebook.php)
* [Twitter](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/Twitter.php)
* [+Google](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/GooglePlus.php)
* [LinkedIn](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/LinkedIn.php)
* [Pinterest](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/Pinterest.php)
* [Tumblr](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/Tumblr.php)
* [Trello](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/Trello.php)

drivers for messengers:

* [Telegram](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/Telegram.php)
* [Viber](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/Viber.php)
* [WhatsApp](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/WhatsApp.php)

and other drivers:

* [Gmail](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/Gmail.php)
* [Yahoo](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/Yahoo.php)

also you can [create](docs/guide/create-driver.md) your driver, it's very simple!

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ composer require yiimaker/yii2-social-share
```

or add

```
"yiimaker/yii2-social-share": "~2.3"
```

to the `require` section of your `composer.json`.

Usage
-----

Configure social networks in config file

```php
    'components' => [
        // ...
        'socialShare' => [
            'class' => \ymaker\social\share\configurators\Configurator::class,
            'socialNetworks' => [
                'facebook' => [
                    'class' => \ymaker\social\share\drivers\Facebook::class,
                ],
            ],
        ],
    ],
```


and then call widget in view file

```php
<?= \ymaker\social\share\widgets\SocialShare::widget([
    'configurator'  => 'socialShare',
    'url'           => \yii\helpers\Url::to('absolute/route/to/page', true),
    'title'         => 'Title of the page',
    'description'   => 'Description of the page...',
    'imageUrl'      => \yii\helpers\Url::to('absolute/route/to/image.png', true),
]); ?>
```

Tests
-----

You can run tests with composer command

```
$ composer tests
```

or using following command

```
$ ./vendor/bin/codecept build && ./vendor/bin/codecept run
```

Contributing
------------

For information about contributing please read [CONTRIBUTING.md](CONTRIBUTING.md).

Sponsoring
----------

<a href="https://www.buymeacoffee.com/OCmHjEY" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" alt="Buy Me A Coffee" style="height: 60px !important;width: 217px !important;" ></a>

License
-------

[![License](https://img.shields.io/github/license/yiimaker/yii2-social-share.svg)](https://packagist.org/packages/yiimaker/yii2-social-share)

This project is released under the terms of the BSD-3-Clause [license](LICENSE).

Copyright (c) 2017-2021, Volodymyr Kupriienko
