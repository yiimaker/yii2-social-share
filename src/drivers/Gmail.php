<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\drivers;

use ymaker\social\share\base\DriverAbstract;

/**
 * DriverAbstract for Gmail.
 * @link https://gmail.google.com
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class Gmail extends DriverAbstract
{
    /**
     * @var string
     */
    public $bodyPattern = '{description} - {url}';


    /**
     * @inheritdoc
     */
    protected function processShareData()
    {
        $this->title = static::encodeData($this->title);
        $this->appendToData('body', strtr($this->bodyPattern, [
            '{url}'         => $this->url,
            '{description}' => $this->description,
            '{imageUrl}'    => $this->imageUrl
        ]));
    }

    /**
     * @inheritdoc
     */
    protected function buildLink()
    {
        return 'https://mail.google.com/mail/?view=cm&fs=1&su={title}&body={body}';
    }
}
