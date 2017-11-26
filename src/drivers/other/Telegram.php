<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\drivers\other;

use ymaker\social\share\base\Driver;

/**
 * Driver for Telegram messenger.
 * @link https://telegram.org
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class Telegram extends Driver
{
    /**
     * @var bool|string
     */
    public $message = false;


    /**
     * @inheritdoc
     */
    public function getLink()
    {
        $this->_link = 'https://telegram.me/share/url?url={url}';

        if ($this->message) {
            $this->_data['{message}'] = $this->message;
            $this->addUrlParam('text', '{message}');
        }

        return parent::getLink();
    }

    /**
     * @inheritdoc
     */
    protected function processShareData()
    {
        $this->url = static::encodeData($this->url);
        if (is_string($this->message)) {
            $this->message = static::encodeData($this->message);
        }
    }
}
