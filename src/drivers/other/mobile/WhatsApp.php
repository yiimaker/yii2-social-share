<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\drivers\other\mobile;

use ymaker\social\share\base\Driver;

/**
 * Driver for WhatsApp messenger
 * @link https://www.whatsapp.com
 *
 * WARNING: This driver works only in mobile devices
 * with installed WhatsApp client
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class WhatsApp extends Driver
{
    /**
     * @inheritdoc
     */
    public function getLink()
    {
        $this->_link = 'whatsapp://send?text={url}';

        return parent::getLink();
    }

    /**
     * @inheritdoc
     */
    protected function processShareData()
    {
        $this->url = static::encodeData($this->url);
    }
}
