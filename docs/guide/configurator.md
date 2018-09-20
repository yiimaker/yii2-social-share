Configurator
============

## Configuration options

| Option            | Description                                                                       | Type  | Default                                       |
|-------------------|-----------------------------------------------------------------------------------|-------|-----------------------------------------------|
|socialNetworks     |Array with configuration for social network drivers                                |array  |-                                              |
|options            |HTML options for share-links                                                       |array  |-                                              |
|enableSeoOptions   |Enable/disable appending of SEO options to share links                             |bool   |true                                           |
|seoOptions         |SEO options for share-links                                                        |array  |`['target' => '_blank', 'rel' => 'noopener']`  |
|enableDefaultIcons |(DEPRECATED) Enable/disable default icons asset and icons instead of text labels   |bool   |false                                          |
|enableIcons        |Enable/disable icons instead of text labels                                        |bool   |false                                          |
|enableDefaultAsset |Enable/disable default icons asset                                                 |bool   |true                                           |
|icons              |Array with drivers names and icons selectors                                       |array  |Default icons set will be used                 |
|registerMetaTags   |Enable/disable registering of drivers meta tags                                    |bool   |true                                           |

## Configuration examples

### icons

```php
'enableIcons' => true,
'icons' => [
    \ymaker\social\share\drivers\Twitter::class => 'icon-twitter', // CSS class
    \ymaker\social\share\drivers\Facebook::class => 'icon-facebook',  // CSS class
],
```

## Create my configurator component

If you want to create your configurator, you should:

1. Create class and inherit it from `\yii\base\BaseObject` or `\yii\base\Component`
2. Implement the [ConfiguratorInterface](https://github.com/yiimaker/yii2-social-share/blob/master/src/configurators/ConfiguratorInterface.php) interface
3. For supporting icons and SEO you can implement [IconsConfigInterface](https://github.com/yiimaker/yii2-social-share/blob/master/src/configurators/IconsConfigInterface.php),
[SeoConfigInterface](https://github.com/yiimaker/yii2-social-share/blob/master/src/configurators/SeoConfigInterface.php) interfaces
