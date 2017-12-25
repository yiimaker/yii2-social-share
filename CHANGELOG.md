Social Share Change Log
=======================

1.4.1 December 25, 2017
-----------------------
* Fix #5: Fixes vulnerability of `target="_blank"`
* Chg: Using '<!--noindex-->' comment instead of 'rel="nofollow"' attribute

1.4.0 December 12, 2017 
-----------------------
* Enh: Created driver for Tumblr
* Enh: Added `driverProperties` property to widget for adding of
custom properties to drivers
* Enh: Creates unit tests for `Tumblr`, `Twitter`, `LinkedIn`, `Telegram`,
 `Facebook`, `Gmail` drivers
* Enh: Using minified version of CSS file for social icons on production
* Fix: Using `Html::tag()` instead of `Html::a()` in widget
* Fix: Call parent implementation of method `init()` in widget
* Fix: Encode `body` param in Gmail driver

1.3.0 October 02, 2017
----------------------
* Enh: Code style
* Enh: Refactored widget
* Enh: Use Inflector in widget for default link labels
* Fix: Bug with configurator in widget

1.2.0 August 29, 2017
---------------------
* Enh: Improved PHPDoc blocks
* Enh: Refactored widget
* Enh: Adds more tests
* Fix: Code style

1.1.0 June 14, 2017
-------------------
* Fix: Docs
* Fix: Issue with wrapper tag in widget
* Chg: Updates min Yii version to 2.0.0
* Chg: Updates min codeception version to ~2.2

1.0.0 March 29, 2017
--------------------
* Initial release

Development started March 19, 2017
----------------------------------