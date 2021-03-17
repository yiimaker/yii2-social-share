<?php

/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2021 Volodymyr Kupriienko
 * @license BSD 3-Clause License
 */

use ymaker\social\share\configurators\Configurator;

$drivers = [
    'vkontakte' => [
        'class' => \ymaker\social\share\drivers\Vkontakte::class,
    ],
    'facebook' => [
        'class' => \ymaker\social\share\drivers\Facebook::class,
    ],
    'twitter' => [
        'class' => \ymaker\social\share\drivers\Twitter::class,
    ],
    'googlePlus' => [
        'class' => \ymaker\social\share\drivers\GooglePlus::class,
    ],
    'linkedin' => [
        'class' => \ymaker\social\share\drivers\LinkedIn::class,
    ],
    'pinterest' => [
        'class' => \ymaker\social\share\drivers\Pinterest::class,
    ],
    'telegram' => [
        'class' => \ymaker\social\share\drivers\Telegram::class,
    ],
    'viber' => [
        'class' => \ymaker\social\share\drivers\Viber::class,
    ],
    'whatsApp' => [
        'class' => \ymaker\social\share\drivers\WhatsApp::class,
    ],
    'gmail' => [
        'class' => \ymaker\social\share\drivers\Gmail::class,
    ],
    'tumblr' => [
        'class' => \ymaker\social\share\drivers\Tumblr::class,
    ],
    'yahoo' => [
        'class' => \ymaker\social\share\drivers\Yahoo::class,
    ],
    'odnoklassniki' => [
        'class' => \ymaker\social\share\drivers\Odnoklassniki::class,
    ],
    'trello' => [
        'class' => \ymaker\social\share\drivers\Trello::class,
    ],
];

return [
    'defaultConfig' => [
        'class' => Configurator::class,
        'socialNetworks' => $drivers,
    ],
    'defaultIcons' => [
        'class' => Configurator::class,
        'enableIcons' => true,
        'socialNetworks' => $drivers,
    ],
    'disableMetaTags' => [
        'class' => Configurator::class,
        'registerMetaTags' => false,
    ],
];
