Social Share Change Log
=======================

2.3.2 June 27, 2019
-------------------
* Chg: Updated dependencies in composer.lock file (greeflas)

2.3.1 January 11, 2019
----------------------
* Chg: Updated dev dependencies for PHP 7.3 supporting (greeflas)
* Fix: PHP-CS-Fixer config file name (greeflas)

2.3.0 September 20, 2018
------------------------
* Enh #16: Adds `enableIcons` and `enableDefaultAsset` option to the default configurator instead of `enableDefaultIcons` (greeflas, dimmitri)
* Enh: Improves architecture of configurator, adds more abstraction to reduce dependency to the default implementation in widget (greeflas)
* Chg: Deprecate `enableDefaultIcons` option of the default configurator (greeflas)

2.2.0 April 22, 2018
--------------------
* Enh #13: Created driver for Trello (greeflas)
* Fix: Fixed bug with duplicates of registered meta tags (greeflas)

2.1.0 March 18, 2018
--------------------
* Enh: Created driver for Odnoklassniki (sokolnikov911)
* Enh #12: Added option for enable/disable registering of drivers meta tags (greeflas)

2.0.0 January 18, 2018
----------------------
* Enh: Refactored base driver class and improved creating of custom drivers (greeflas)
* Enh: Refactored social share widget for improve configuration (greeflas)
* Enh #8: Created driver for Yahoo (greeflas)
* Chg #4: Changed minimum Yii version from `^2.0.0` to `^2.0.13` (greeflas)
* Chg: Removed unused dev packages `codeception/verify` and `codeception/specify`
* Fix #7: Wrong path to icon-font files in CSS files (greeflas, sokolnikov911)
* Fix: Some fixes in files for unit tests (greeflas)

1.4.1 December 25, 2017
-----------------------
* Fix #5: Fixes vulnerability of `target="_blank"` (greeflas)
* Chg: Using `<!--noindex-->` comment instead of `rel="nofollow"` attribute (greeflas)

1.4.0 December 12, 2017
-----------------------
* Enh #2: Created driver for Tumblr (greeflas)
* Enh: Added `driverProperties` property to widget for adding of
custom properties to drivers (greeflas)
* Enh: Creates unit tests for `Tumblr`, `Twitter`, `LinkedIn`, `Telegram`,
 `Facebook`, `Gmail` drivers (greeflas)
* Enh: Using minified version of CSS file for social icons on production (greeflas)
* Fix: Using `Html::tag()` instead of `Html::a()` in widget (greeflas)
* Fix: Call parent implementation of method `init()` in widget (greeflas)
* Fix: Encode `body` param in Gmail driver (greeflas)

1.3.0 October 02, 2017
----------------------
* Enh: Code style (greeflas)
* Enh: Refactored widget (greeflas)
* Enh: Use Inflector in widget for default link labels (greeflas)
* Fix: Bug with configurator in widget (greeflas)

1.2.0 August 29, 2017
---------------------
* Enh: Improved PHPDoc blocks (greeflas)
* Enh: Refactored widget (greeflas)
* Enh: Adds more tests (greeflas)
* Fix: Code style (greeflas)

1.1.0 June 14, 2017
-------------------
* Fix: Docs (greeflas)
* Fix: Issue with wrapper tag in widget (greeflas)
* Chg: Updates min Yii version to 2.0.0 (greeflas)
* Chg: Updates min codeception version to ~2.2 (greeflas)

1.0.0 March 29, 2017
--------------------
* Initial release (greeflas)

Development started March 19, 2017
----------------------------------
