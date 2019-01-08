<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2019 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\drivers;

use ymaker\social\share\base\AbstractDriver;

/**
 * Driver for Telegram messenger.
 *
 * @link https://telegram.org
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class Telegram extends AbstractDriver
{
    /**
     * @var bool|string
     */
    public $message = false;


    /**
     * {@inheritdoc}
     */
    protected function processShareData()
    {
        $this->url = static::encodeData($this->url);

        if (\is_string($this->message)) {
            $this->appendToData('message', $this->message);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function buildLink()
    {
        $link = 'https://telegram.me/share/url?url={url}';

        if ($this->message) {
            $this->addUrlParam($link, 'text', '{message}');
        }

        return $link;
    }
}
