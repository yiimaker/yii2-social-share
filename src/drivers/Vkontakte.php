<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\drivers;

use ymaker\social\share\base\Driver;

/**
 * Driver for https://vk.com
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class Vkontakte extends Driver
{
    // TODO: PHPDoc
    public function getLink()
    {
        $this->_link = 'http://vk.com/share.php?'
                    . 'url={url}'
                    . '&title={title}'
                    . '&description={description}'
                    . '&image={imageUrl}';

        return parent::getLink();
    }
}
