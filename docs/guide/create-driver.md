Create my social network driver
===============================

For creating driver for social network you should:

1. Create class and inherit it from `\ymaker\social\share\base\Driver`

```php
use ymaker\social\share\base\Driver;

class LinkedIn extends Driver
{
}
```

2. And implement two methods

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

In `getLink()` method you should assign a string with share-link of social network to `_link` variable and return parent `getLink()` method result.

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

In this string you can use four keys - `{url}`, `{title}`, `{description}` and `{imageUrl}`.
In result this keys will be replaced by data from widget config.

In second method, you should process your data.

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

If data is using in url - you shouldncode this data for correct work of sharing.
Base Driver class has a static method for this.

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