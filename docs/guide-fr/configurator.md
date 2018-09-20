Le configurateur
================

## Les options de configurations

| Option            | Description                                                                                                   | Type  | Défaut                                        |
|-------------------|---------------------------------------------------------------------------------------------------------------|-------|-----------------------------------------------|
|socialNetworks     |Le tableau des configurations des pilotes pour les réseaux sociaux                                             |array  |-                                              |
|options            |Les attributs HTML pour le lien du partage                                                                     |array  |-                                              |
|enableSeoOptions   |L’adjonction des attributs SEO marche/arrêt pour le lien                                                       |bool   |true                                           |
|seoOptions         |Les attributs SEO pour le lien                                                                                 |array  |`['target' => '_blank', 'rel' => 'noopener']`  |
|enableDefaultIcons |(déconseillé) Activer/désactiver un asset d'icônes et des icônes par défaut au lieu des étiquettes de texte    |bool   |false                                          |
|enableIcons        |Activer/désactiver les icôns au lieu des étiquettes de texte                                                   |bool   |false                                          |
|enableDefaultAsset |Activer/désctiver les assets d'icôns par défaut                                                                |bool   |true                                           |
|icons              |Le tableau associatif avec le nom de classe de pilote et le secteur pour l’icône                               |array  |Des icônes par défaut                          |
|registerMetaTags   |Activer l’enregistrement des meta tags des pilotes.                                                            |bool   |true                                           |

## L’exemple de configuration

### Les icônes

```php
'enableIcons' => true,
'icons' => [
    \ymaker\social\share\drivers\Twitter::class => 'icon-twitter', // CSS classe
    \ymaker\social\share\drivers\Facebook::class => 'icon-facebook',  // CSS classe
],
```

## La création de votre propre configurateur

Si vous voulez créer votre propre configurateur, vous devez:

1. Créer la classe et hériter cette classe de `\yii\base\BaseObject` ou `\yii\base\Component`
2. Implémenter l’interface [ConfiguratorInterface](https://github.com/yiimaker/yii2-social-share/blob/master/src/configurators/ConfiguratorInterface.php)
3. Pour supporter les icônes et SEO vous pouvez implémenter les interfaces
[IconsConfigInterface](https://github.com/yiimaker/yii2-social-share/blob/master/src/configurators/IconsConfigInterface.php),
[SeoConfigInterface](https://github.com/yiimaker/yii2-social-share/blob/master/src/configurators/SeoConfigInterface.php)
