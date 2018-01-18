La création de votre propre pilote de réseaux sociaux
=====================================================

Si vous voulez créer votre propre pilote de réseaux sociaux, vous devez:

1. Créer la classe et hériter cette classe de `\ymaker\social\share\base\AbstractDriver`

```php
use ymaker\social\share\base\AbstractDriver;

class LinkedIn extends AbstractDriver
{
}
```

2. Mettre en œuvre les deux méthodes

```php
use ymaker\social\share\base\AbstractDriver;

class LinkedIn extends AbstractDriver
{
    /**
     * @inheritdoc
     */
    protected function processShareData()
    {
    }

    /**
     * @inheritdoc
     */
    protected function buildLink()
    {
    }
}
```

Dans la méthode`processShareData()` il faut traiter les données

```php
/**
 * @inheritdoc
 */
protected function processShareData()
{
    $this->url = static::encodeData($this->url);
    $this->title = static::encodeData($this->title);
    $this->description = static::encodeData($this->description);
}
```

Si vous utilisez les données dans url - vous devez encoder ces données pour le travail correct du partage.
La classe de base`AbstractDriver` a la méthode statique pour ça.

Dans `buildLink()` returnez l'exemple du lien de partage

```php
/**
 * @inheritdoc
 */
protected function buildLink()
{
    return 'https://www.linkedin.com/shareArticle?mini=true'
        . '&url={url}'
        . '&title={title}'
        . '&summary={description}';
}
```

Dans ce chaîne il faut utiliser quatre clés - `{url}`, `{title}`, `{description}` et `{imageUrl}`.
Comme le résultat ces clés seront remplacées par les données de widget config.

Si vous voulez enregistrer les méta-tags, vous devez écarter la méthode `getMetaTags()` 

```php
/**
 * @return array
 */
protected function getMetaTags()
{
    return [
        ['property' => 'og:url',         'content' => '{url}'],
        ['property' => 'og:type',        'content' => 'website'],
        ['property' => 'og:title',       'content' => '{title}'],
        ['property' => 'og:description', 'content' => '{description}'],
        ['property' => 'og:image',       'content' => '{imageUrl}'],
    ];
}
```

Maintenant, vous pouvez utiliser ce pilote dans le configurateur

```php
'components' => [
    // ...
    'socialShare' => [
        'class' => \ymaker\social\share\configurators\Configurator::class,
        'socialNetworks' => [
            'linkedIn' => [
                'class' => \namespace\of\my\driver\LinkedIn::class,
                'label' => Yii::t('app', 'LinkedIn'),
                'options' => ['class' => 'in'],
            ],
        ],
    ],
],
```