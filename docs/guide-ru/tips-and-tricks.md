Советы и фичи
=============

## Использование HTML контента вместо текстовых лэйблов

```php
'components' => [
    // ...
    'socialShare' => [
        'class' => \ymaker\social\share\configurators\Configurator::class,
        'socialNetworks' => [
            'facebook' => [
                'class' => \ymaker\social\share\drivers\Facebook::class,
                'label' => \yii\helpers\Html::tag('i', '', ['class' => 'icon-fb']),
            ],
            // ...
        ],
    ],
],
```

## Переводы для текстовых лэйблов

```php
'components' => [
    // ...
    'socialShare' => [
        'class' => \ymaker\social\share\configurators\Configurator::class,
        'socialNetworks' => [
            'facebook' => [
                'class' => \ymaker\social\share\drivers\Facebook::class,
                'label' => Yii::t('app', 'Facebook'),
            ],
            // ...
        ],
    ],
],
```

Переопределиние иконки в стандартном наборе иконок
--------------------------------------------------

В этом примере для Facebook будет использоваться CSS класс `my-facebook-icon`.
Для остальных социальных сетей будут использоваться стандартные иконки.

```php
'components' => [
    // ...
    'socialShare' => [
        'class' => \ymaker\social\share\configurators\Configurator::class,
        'enableDefaultIcons' => true,
        'icons' => [
            \ymaker\social\share\drivers\Facebook::class => 'my-facebook-icon',
        ],
    ],
],
```

## Использование разных социальных сетей на разных страницах

Настройте несколько компонентов в конфигурации приложения

```php
'components' => [
    // ...
    'socialShareBlog' => [
        'class' => \ymaker\social\share\configurators\Configurator::class,
        'socialNetworks' => [
            'facebook' => [
                'class' => \ymaker\social\share\drivers\Facebook::class,
                'label' => Yii::t('app', 'Facebook'),
            ],
            'twitter' => [
                'class' => \ymaker\social\share\drivers\Twitter::class,
                'label' => Yii::t('app', 'Twitter'),
            ],
            'googlePlus' => [
                'class' => \ymaker\social\share\drivers\GooglePlus::class,
                'label' => Yii::t('app', '+Google'),
            ],
        ],
    ],
    'socialShareMessangers', => [
        'class' => \ymaker\social\share\configurators\Configurator::class,
        'socialNetworks' => [
            'telegram' => [
                'class' => \ymaker\social\share\drivers\other\Telegram::class,
                'label' => Yii::t('app', 'Telegram'),
            ],
            'viber' => [
                'class' => \ymaker\social\share\drivers\other\mobile\Viber::class,
                'label' => Yii::t('app', 'Viber'),
            ],
            'whatsApp' => [
                'class' => \ymaker\social\share\drivers\other\mobile\WhatsApp::class,
                'label' => Yii::t('app', 'Whats app'),
            ],
        ],
    ],
],
```

Вызовите виджет с нужным компонентом в файлах представления

```php
// blog-article.php файл представления

<?= \ymaker\social\share\widgets\SocialShare::widget([
    'configuratorId' => 'socialShareBlog', // ID нужного компонента
    'url'            => \yii\helpers\Url::to('/blog', true),
    'title'          => 'Blog page',
    'description'    => 'This is blog page',
    'imageUrl'       => \yii\helpers\Url::to('/images/blog.png', true),
]); ?>
```

```php
// main.php лэйаут файл

<?= \ymaker\social\share\widgets\SocialShare::widget([
    'configuratorId' => 'socialShareMessangers', // ID нужного компонента
    'url'            => \yii\helpers\Url::to('/', true),
    'title'          => 'Site name',
    'description'    => 'Welcome to my site!',
    'imageUrl'       => \yii\helpers\Url::to('/images/hello.png', true),
]); ?>
```