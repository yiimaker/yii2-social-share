<p align="center">
    <a href="https://github.com/yiimaker" target="_blank">
        <img src="https://avatars1.githubusercontent.com/u/24204902" height="100px">
    </a>
    <h1 align="center">L’extension pour le partage sur les réseaux sociaux</h1>
</p>

Avec cette extension vous pouvez partager vos informations à partir de votre page web  à tous réseaux sociaux.
Les caractéristiques: SEO support, les icones par défaut pour les réseaux sociaux, la création facile des pilotes personnalisés (custom drivers) pour les autres réseaux sociaux, etc.

L’extension supporte les pilotes pour les réseaux sociaux suivantes:

* [Vkontakte](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/Vkontakte.php)
* [Facebook](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/Facebook.php)
* [Twitter](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/Twitter.php)
* [+Google](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/GooglePlus.php)
* [LinkedIn](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/LinkedIn.php)
* [Pinterest](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/Pinterest.php)
* [Tumblr](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/Tumblr.php)

aussi bien que les pilotes pour les messagers:
* [Telegram](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/other/Telegram.php)
* [Viber](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/other/mobile/Viber.php)
* [WhatsApp](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/other/mobile/WhatsApp.php)
* [Gmail](https://github.com/yiimaker/yii2-social-share/blob/master/src/drivers/other/Gmail.php)

Vous pouvez également créer votre propre pilote, ça c’est très simple!

L’installation
--------------

#### Un package d’iInstallation

Exécutez une commande
```
$ composer require yiimaker/yii2-social-share
```

ou ajoutez
```json
"yiimaker/yii2-social-share": "~1.0"
```
dans la section requise de votre `composer.json` file.

L'utilisation
-------------
* [L'utilisation de base](basic-usage.md)
* [L'utilisation avancée](advanced-usage.md)
* [Les trucks et astuces](tips-and-tricks.md)

Les tests
---------
Vous pouvez  faire les testes avec l’aide de la commande Composer

```bash
$ composer test
```

ou par l’utilisation de la commande suivante

```bash
$ codecept build && codecept run
```

La licence
----------

Ce projet a été lance selon les termes de BSD-3-Clause [licence](https://github.com/yiimaker/yii2-social-share/blob/master/LICENSE).

Copyright (c) 2017, Yii Maker
