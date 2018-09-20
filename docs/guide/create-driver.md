Create my social network driver
===============================

For creating driver for social network you should:

1. Create class and inherit it from `\ymaker\social\share\base\AbstractDriver`

```php
use ymaker\social\share\base\AbstractDriver;

class LinkedIn extends AbstractDriver
{
}
```

2. And implement two methods

```php
use ymaker\social\share\base\AbstractDriver;

class LinkedIn extends AbstractDriver
{
    /**
     * {@inheritdoc}
     */
    protected function processShareData()
    {
    }

    /**
     * {@inheritdoc}
     */
    protected function buildLink()
    {
    }
}
```

In `processShareData()` method you should process data

```php
/**
 * {@inheritdoc}
 */
protected function processShareData()
{
    $this->url = static::encodeData($this->url);
    $this->title = static::encodeData($this->title);
    $this->description = static::encodeData($this->description);
}
```

If data is using in url - you should encode this data for correct work of sharing.
Base `AbstractDriver` class has a static method for this.

In `buildLink()` return a share link pattern

```php
/**
 * {@inheritdoc}
 */
protected function buildLink()
{
    return 'https://www.linkedin.com/shareArticle?mini=true'
        . '&url={url}'
        . '&title={title}'
        . '&summary={description}'
    ;
}
```

In this string you can use four keys - `{url}`, `{title}`, `{description}` and `{imageUrl}`.
In result this keys will be replaced by data from widget config.

If you need to register some meta tags you should override `getMetaTags()` method

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

Now you can use this driver in configurator

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
