<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2019 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\drivers;

use ymaker\social\share\base\AbstractDriver;

/**
 * Driver for Twitter.
 *
 * @link https://twitter.com
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class Twitter extends AbstractDriver
{
    /**
     * @var bool|string
     */
    public $account = false;


    /**
     * {@inheritdoc}
     */
    protected function processShareData()
    {
        $this->url = static::encodeData($this->url);
        $this->description = static::encodeData($this->description);

        if (\is_string($this->account)) {
            $this->appendToData('account', $this->account);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function buildLink()
    {
        $link = 'http://twitter.com/share?url={url}&text={description}';

        if ($this->account) {
            $this->addUrlParam($link, 'via', '{account}');
        }

        return $link;
    }

    /**
     * {@inheritdoc}
     */
    protected function getMetaTags()
    {
        return [
            ['name' => 'twitter:card',         'content' => 'summary_large_image'],
            ['name' => 'twitter:title',        'content' => '{title}'],
            ['name' => 'twitter:description',  'content' => '{description}'],
            ['name' => 'twitter:image',        'content' => '{imageUrl}'],
        ];
    }
}
