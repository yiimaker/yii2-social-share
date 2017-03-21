Advanced usage
==============

Configurator
------------

#### 1) Configuration options

| Option | Description | Type | Default |
|----|----|----|----|
|socialNetworks|Array with configuration for social network drivers|array|-|
|options|HTML options for share links|array|-|
|enableSeoOptions|Enable/disable appending of SEO options to share links|bool|true|
|seoOptions|SEO options for share links|array|`['target' => '_blank', 'rel' => 'nofollow']`|

#### 2) Create my configurator component

If you want to create your configurator, you should to:
1. Create class end inherit it from `\yii\base\Object` or `\yii\base\Component`
2. Implement the [ConfiguratorInterface](https://github.com/yiimaker/yii2-social-share/blob/master/src/configurators/ConfiguratorInterface.php) interface
3. And implement methods from this interface

SocialShare widget
------------------

#### 1) Configuration options

| Option | Description | Type | Default |
|----|----|----|----|
|configuratorId|ID of configurator component from app config|string|-|
|url|Absolute URL to share page|string|Result of `Url::to('', true)`|
|title|Title of share page|string|-|
|description|Description of share page|string|-|
|imageUrl|Absolute URL to image for share page|string|-|
|wrapperTag|Wrapper HTML tag name for all share links|string|ul|
|wrapperOptions|HTML options for wrapper tag|array|`['class' => 'social-share']`|
|linkWrapperTag|Wrapper HTML tag name for one share link|bool/string|li|
|linkWrapperOptions|HTML options for link wrapper tag|array|-|

Social network drivers
----------------------

#### 1) Configuration options

| Option | Description | Type | Default |
|----|----|----|----|
|class|Class name of driver|string|-|
|label|Label for displaying in link tag|string|By default widget will be displaying key of array with driver config|
|options|HTML options for share link. CSS class will be appended to classes from configurator options. Other options will be overridden.|array|-|
|config|Array with configuration for class fields of driver (if driver has custom fields for configuration)|array|-|

#### 2) Create my social network driver

For creating of driver for social network you should to:

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

In `getLink()` method you should assign a string with share link of social network to `_link` variable and return parent `getLink()` method result.

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

In this string you can use a four keys - `{url}`, `{title}`, `{description}` and `{imageUrl}`.
In result this keys will be replaced by data from widget config.

In second method, you should to process your data.

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

If data will be using in url - you should to encode this data for correct work of sharing.
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
                'options' => ['class' => 'in']
            ],
        ],
    ],
```