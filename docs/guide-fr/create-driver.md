La création de votre propre pilote de réseaux sociaux
=====================================================

Si vous voulez créer votre propre pilote de réseaux sociaux, vous devez:

1. Créer la classe et hériter ce classe de `\ymaker\social\share\base\Driver`

```php
use ymaker\social\share\base\Driver;

class LinkedIn extends Driver
{
}
```

2. Mettre en œuvre les deux méthodes

```php
use ymaker\social\share\base\Driver;

class LinkedIn extends Driver
{
    /**
     * @inheritdoc
     */
    public function getLink()
    {
    }
    
    /**
     * @inheritdoc
     */
    protected function processShareData()
    {
    }
}
```

Dans la méthode `getLink()` vous devrez assigner le chaîne avec le lien de partage des réseaux social à la
variable `_link` et retourner la méthode parental `getLink()` résultat.

```php
/**
 * @inheritdoc
 */
public function getLink()
{
    $this->_link = 'https://www.linkedin.com/shareArticle?mini=true'
                    . '&url={url}'
                    . '&title={title}'
                    . '&summary={description}';
                    
    return parent::getLink();
}
```

Dans ce chaîne il faut utiliser quatre clés - `{url}`, `{title}`, `{description}` et `{imageUrl}`.
Comme le résultat ces clés seront remplacées par les données de widget config.

Si vous voulez enregistrer les méta-tags, il faut ajouter ces tags au tableau `_metaTags` array

```php
/**
 * @inheritdoc
 */
public function getLink()
{
    $this->_metaTags = [
        ['property' => 'og:url',         'content' => '{url}'],
        ['property' => 'og:type',        'content' => 'website'],
        ['property' => 'og:title',       'content' => '{title}'],
        ['property' => 'og:description', 'content' => '{description}'],
        ['property' => 'og:image',       'content' => '{imageUrl}'],
    ];
                    
    return parent::getLink();
}
```

Dans la seconde méthode vous devrez traiter vos données.

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

Si les données sont utilisées dans url – vous devrez encoder cette information pour garantir un usage correct du partage.
La classe Base Driver a la méthode statique pour ça.

Maintenant, vous pouvez utiliser ce pilote dans le configurateur.

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