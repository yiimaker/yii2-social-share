<?php

/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2019 Yii Maker
 * @license BSD 3-Clause License
 */

\error_reporting(E_ALL);

\defined('YII_DEBUG') || \define('YII_DEBUG', true);
\defined('YII_ENABLE_ERROR_HANDLER') || \define('YII_ENABLE_ERROR_HANDLER', false);
\defined('YII_ENV') || \define('YII_ENV', 'test');
\defined('VENDOR_DIR') || \define('VENDOR_DIR', __DIR__ . \implode(DIRECTORY_SEPARATOR, ['', '..', 'vendor']));

require_once VENDOR_DIR . DIRECTORY_SEPARATOR . 'autoload.php';
require_once VENDOR_DIR . \implode(DIRECTORY_SEPARATOR, ['', 'yiisoft', 'yii2', 'Yii.php']);

Yii::setAlias('@tests', __DIR__);
Yii::setAlias('@vendor', VENDOR_DIR);
Yii::setAlias('@data', __DIR__ . DIRECTORY_SEPARATOR . '_data');

Yii::setAlias('@webroot/assets', '@tests/_output');
Yii::setAlias('@web/assets', '@tests/_output');
Yii::setAlias('@vendor/yiimaker/yii2-social-share/src/assets/src', '@tests/../src/assets/src');
