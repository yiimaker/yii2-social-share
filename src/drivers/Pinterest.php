<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\drivers;

use ymaker\social\share\base\Driver;

/**
 * Driver for https://pinterest.com
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class Pinterest extends Driver
{
    /**
     * @inheritdoc
     */
    public function getLink()
    {
        $this->_link = 'https://www.pinterest.com/pin/create/link/?'
                    . 'url={url}'
                    . '&media={imageUrl}'
                    . '&description={description}';

        return parent::getLink();
    }

    /**
     * @inheritdoc
     */
    protected function processShareData()
    {
        $this->url = static::encodeData($this->url);
        $this->imageUrl = static::encodeData($this->imageUrl);
        $this->description = static::encodeData($this->description);
    }
}
