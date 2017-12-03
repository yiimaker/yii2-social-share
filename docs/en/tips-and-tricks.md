Tips and tricks
===============

Using HTML content instead of text labels
-----------------------------------------

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

Translate text labels
---------------------

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

Overwrite icon in default icons set
-----------------------------------

CSS class `my-facebook-icon` will be used for Facebook driver in this example.
Default icons will be used for other social networks.

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

Using of different social networks in different pages
-----------------------------------------------------

Configure several social share components in app config

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

Call widget in view files

```php
// blog-article.php view file

<?= \ymaker\social\share\widgets\SocialShare::widget([
    'configuratorId' => 'socialShareBlog', // Social share component ID
    'url'            => \yii\helpers\Url::to('/blog', true),
    'title'          => 'Blog page',
    'description'    => 'This is blog page',
    'imageUrl'       => \yii\helpers\Url::to('/images/blog.png', true),
]); ?>
```

```php
// main.php layout file

<?= \ymaker\social\share\widgets\SocialShare::widget([
    'configuratorId' => 'socialShareMessangers', // Social share component ID
    'url'            => \yii\helpers\Url::to('/', true),
    'title'          => 'Site name',
    'description'    => 'Welcome to my site!',
    'imageUrl'       => \yii\helpers\Url::to('/images/hello.png', true),
]); ?>
```