<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2019 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\drivers;

use ymaker\social\share\base\AbstractDriver;

/**
 * Driver for Trello.
 *
 * @link https://trello.com
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 2.2
 */
class Trello extends AbstractDriver
{
    /**
     * {@inheritdoc}
     */
    protected function processShareData()
    {
        $this->url = static::encodeData($this->url);
        $this->title = static::encodeData($this->title);
    }

    /**
     * {@inheritdoc}
     */
    protected function buildLink()
    {
        return 'https://trello.com/add-card'
            . '?url={url}'
            . '&name={title}'
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function getMetaTags()
    {
        return [['property' => 'og:description', 'content' => '{description}']];
    }
}
