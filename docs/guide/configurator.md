Configurator
============

## Configuration options

| Option            | Description                                           | Type  | Default                                       |
|-------------------|-------------------------------------------------------|-------|-----------------------------------------------|
|socialNetworks     |Array with configuration for social network drivers    |array  |-                                              |
|options            |HTML options for share-links                           |array  |-                                              |
|enableSeoOptions   |Enable/disable appending of SEO options to share links |bool   |true                                           |
|seoOptions         |SEO options for share-links                            |array  |`['target' => '_blank', 'rel' => 'noopener']`  |
|enableDefaultIcons |Enable/disable default icons instead of text labels    |bool   |false                                          |
|icons              |Array with drivers names and icons selectors           |array  |Default icons set will be used                 |
|registerMetaTags   |Enable/disable registering of drivers meta tags.       |bool   |true                                           |

## Configuration examples

### icons

```php
'icons' => [
    \ymaker\social\share\drivers\Twitter::class => 'icon-twitter', // CSS class
    \ymaker\social\share\drivers\Facebook::class => 'icon-facebook',  // CSS class
],
```

## Create my configurator component

If you want to create your configurator, you should:

1. Create class and inherit it from `\yii\base\BaseObject` or `\yii\base\Component`
2. Implement the [ConfiguratorInterface](https://github.com/yiimaker/yii2-social-share/blob/master/src/configurators/ConfiguratorInterface.php) interface
3. And implement methods of this interface
