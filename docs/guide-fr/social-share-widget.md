Social share widget
===================

## Les options de configuration

| Option                | Description                                                                                                           | Type                                                                  | Défaut                                        |
|-----------------------|-----------------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------|-----------------------------------------------|
|configurator           |ID de composant de configurateur d'app config. Le tableau de configuration ou l'objet du configurateur                 |string|array|ymaker\social\share\configurators\ConfiguratorInterface   |-                                              |
|url                    |URL absolu pour partager la page                                                                                       |string                                                                 |Result of `Url::to('', true)`                  |
|title                  |Le titulaire de la page du partage                                                                                     |string                                                                 |-                                              |
|description            |La description de la page                                                                                              |string                                                                 |-                                              |
|imageUrl               |URL absolu pour l'image de la page du partage                                                                          |string                                                                 |-                                              |
|driverProperties       |Les propriétés spéciales pour le pilote spécifique                                                                     |array                                                                  |-                                              |
|containerOptions       |Les options HTML pour le container tag avec des liens. Si vous n'allez pas les utiliser - mettez tag option à false.   |array                                                                  |`['tag' => 'ul', 'class' => 'social-share']`   |
|linkContainerOptions   |Les options HTML pour le container tag avec le lien. Si vous n’allez pas l'utiliser - mettez tag option à false.       |array                                                                  |`['tag' => 'li']`                              |

## Les exemples de configuration

### configurator

```php
'configurator' => 'socialShare', // l'identifiant du configurateur de config d'application
```

```php
'configurator' => \Yii::$app->get('socailShare'), // l'instance du composant
```

### driverProperties

```php
'driverProperties' => [
    \ymaker\social\share\drivers\Twitter::class => [
        'account' => 'yiimaker'
    ],
    \ymaker\social\share\drivers\Tumblr::class => [
        'shareUrl' => \common\helpers\UrlHelper::gallaryPageUrl(),
        'tags' => ['apartments', 'planning'],
    ],
],
```