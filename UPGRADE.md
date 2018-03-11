Upgrading Instructions
======================

This file contains the upgrade notes. These notes highlight changes that could break your
application when you upgrade the package from one version to another.

Upgrade from 1.x to 2.x
-----------------------

* Changed minimum Yii version from `^2.0.0` to `^2.0.13`

* Base class for drivers `Driver` renamed to `AbstractDriver`

* Move all drivers to `ymaker\social\share\drivers` namespace.

* Updates API of `AbstractDriver` class:

    - added `buildLink()`, `getMetaTags()`, `appendToData()` methods
    
    - maked all class properties protected and added setters
    
    - make `addUrlParam()` and `getLink()` methods final
    
    - maked `data` property private and renamed to `_data`

* Updates API of `SocialShare` widget:

    - maked `enableDefaultIcons()` and `isSeoEnabled()` method protected and final
    
    - renamed `processSocialNetworks()` method to `getLinkList()` and maked this method private
    
    - renamed `buildLabel()` method to `getLinkLabel()`
    
    - removed `_configurator` property
    
    - renamed `configuratorId` property to `configurator`
    
    - created `$containerOptions` property instead of `$wrapperTag` and `$wrapperTagOptions`
    
    - created `$linkContainerOptions` property instead of `$linkWrapperTag` and `$linkWrapperOptions`
    
* Removed unused dev packages `codeception/verify` and `codeception/specify`
