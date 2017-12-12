Social share widget
===================

## Les options de configuration

| Option            | Description                                               | Type          | Défaut                        |
|-------------------|-----------------------------------------------------------|---------------|-------------------------------|
|configuratorId     |ID de composant de configurateur d'app config              |string         |-                              |
|url                |Le lien absolu vers la page                                |string         |Result of `Url::to('', true)`  |
|title              |Le titulaire de la page du partage                         |string         |-                              |
|description        |La description de la page                                  |string         |-                              |
|imageUrl           |Le lien absolu vers l'image de la page                     |string         |-                              |
|driverProperties   |Les propriétés spéciales pour le pilote spécifique         |array          |-                              |
|wrapperTag         |Le nom de balise HTML pour l'enveloppe de tous les liens   |string         |ul                             |
|wrapperOptions     |Les attributs HTML pour le balise parent                   |array          |`['class' => 'social-share']`  |
|linkWrapperTag     |Le nom de balise HTML pour un lien du partage              |bool/string    |li                             |
|linkWrapperOptions |Les fonctions de HTML pour le balise parent                |array          |-                              |

## Les exemples de configuration

### configuratorId

```php
'configuratorId' => 'socialShare', // l'identifiant du configurateur de config d'application
```

```php
'configuratorId' => \Yii::$app->get('socailShare'), // l'instance du composant
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