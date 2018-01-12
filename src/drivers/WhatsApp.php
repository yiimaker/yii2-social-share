<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\drivers;

use ymaker\social\share\base\DriverAbstract;

/**
 * DriverAbstract for WhatsApp messenger.
 *
 * @link https://www.whatsapp.com
 *
 * WARNING: This driver works only in mobile devices
 * with installed WhatsApp client.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class WhatsApp extends DriverAbstract
{
    /**
     * @inheritdoc
     */
    protected function processShareData()
    {
        $this->url = static::encodeData($this->url);
    }

    /**
     * @inheritdoc
     */
    protected function buildLink()
    {
        return 'whatsapp://send?text={url}';
    }
}
