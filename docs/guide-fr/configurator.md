Le configurateur
================

## Les options de configurations

| Option            | Description                                                                       | Type  | Défaut                                        |
|-------------------|-----------------------------------------------------------------------------------|-------|-----------------------------------------------|
|socialNetworks     |Le tableau des configurations des pilotes pour les réseaux sociaux                 |array  |-                                              |
|options            |Les attributs HTML pour le lien du partage                                         |array  |-                                              |
|enableSeoOptions   |L’adjonction des attributs SEO marche/arrêt pour le lien                           |bool   |true                                           |
|seoOptions         |Les attributs SEO pour le lien                                                     |array  |`['target' => '_blank', 'rel' => 'noopener']`  |
|enableDefaultIcons |L’utilisation des icônes marche/arrêt à lieu des étiquettes de texte               |bool   |false                                          |
|icons              |Le tableau associatif avec le nom de classe de pilote et le secteur pour l’icône   |array  |Des icônes par défaut                          |

## L’exemple de configuration

### Les icônes

```php
'icons' => [
    \ymaker\social\share\drivers\Twitter::class => 'icon-twitter', // CSS classe
    \ymaker\social\share\drivers\Facebook::class => 'icon-facebook',  // CSS classe
],
```

## La création de votre propre configurateur

Si vous voulez créer votre propre configurateur, vous devez:

1. Créer la classe et hériter cette classe de `\yii\base\BaseObject` ou `\yii\base\Component`
2. Mettre en œuvre l’interface [ConfiguratorInterface](https://github.com/yiimaker/yii2-social-share/blob/master/src/configurators/ConfiguratorInterface.php)
3. Et mettre en œuvre la méthode de cette interface