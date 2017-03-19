<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\drivers;

use ymaker\social\share\base\Driver;

/**
 * Driver for https://twitter.com
 *
 * @property bool|string $account
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class Twitter extends Driver
{
    /**
     * @var bool|string
     */
    public $account = false;


    /**
     * @inheritdoc
     */
    public function getLink()
    {
        $this->_link = 'http://twitter.com/share?'
                    . 'url={url}'
                    . '&text={description}';

        if ($this->account) {
            $this->_data['{account}'] = $this->account;
            $this->_link .= '&via={account}';
        }

        return parent::getLink();
    }

    /**
     * @inheritdoc
     */
    protected function processShareData()
    {
        $this->url = static::encodeData($this->url);
        $this->description = static::encodeData($this->description);
        if ($this->account) {
            $this->account = static::encodeData($this->account);
        }
    }
}
