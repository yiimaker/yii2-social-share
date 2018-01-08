<?php

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
        'class' => \ymaker\social\share\drivers\other\Telegram::class,
    ],
    'viber' => [
        'class' => \ymaker\social\share\drivers\other\mobile\Viber::class,
    ],
    'whatsApp' => [
        'class' => \ymaker\social\share\drivers\other\mobile\WhatsApp::class,
    ],
    'gmail' => [
        'class' => \ymaker\social\share\drivers\other\Gmail::class,
    ],
    'tumblr' => [
        'class' => \ymaker\social\share\drivers\Tumblr::class,
    ],
];

return [
    'defaultConfig' => [
        'class' => \ymaker\social\share\configurators\Configurator::class,
        'socialNetworks' => $drivers,
    ],
    'defaultIcons' => [
        'class' => \ymaker\social\share\configurators\Configurator::class,
        'enableDefaultIcons' => true,
        'socialNetworks' => $drivers
    ],
];
