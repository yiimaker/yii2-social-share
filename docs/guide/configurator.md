Configurator
============

Configuration options
---------------------

| Option | Description | Type | Default |
|--------|-------------|------|---------|
|socialNetworks|Array with configuration for social network drivers|array|-|
|options|HTML options for share-links|array|-|
|enableSeoOptions|Enable/disable appending of SEO options to share links|bool|true|
|seoOptions|SEO options for share-links|array|`['target' => '_blank', 'rel' => 'nofollow']`|
|enableDefaultIcons|Enable/disable default icons instead of text labels|bool|false|
|icons|Array with drivers names and icons selectors|array|Default icons set will be used|

Create my configurator component
--------------------------------

If you want to create your configurator, you should:

1. Create class and inherit it from `\yii\base\Object` or `\yii\base\Component`
2. Implement the [ConfiguratorInterface](https://github.com/yiimaker/yii2-social-share/blob/master/src/configurators/ConfiguratorInterface.php) interface
3. And implement methods of this interface