Upgrading Instructions
======================

This file contains the upgrade notes. These notes highlight changes that could break your
application when you upgrade the package from one version to another.

Upgrade from 1.x to 2.x
-----------------------

* Changed minimum Yii version from `^2.0.0` to `^2.0.13`

* Base class for drivers `Driver` renamed to `DriveAbstract`

* Updates API of `DriverAbstract` class: added `buildLink()`, `getMetaTags()`, `appendToData()` methods,
make all class properties protected and added setters, make `addUrlParam()` and `getLink()` methods final,
make `data` property private and renamed to `_data`.

* Move all drivers to `ymaker\social\share\drivers` namespace.