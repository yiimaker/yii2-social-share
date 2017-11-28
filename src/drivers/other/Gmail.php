<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\drivers\other;

use ymaker\social\share\base\Driver;

/**
 * Driver for Gmail.
 * @link https://gmail.google.com
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class Gmail extends Driver
{
    /**
     * @var string
     */
    public $bodyPattern = '{description} - {url}';

    /**
     * @var string
     */
    protected $body;


    /**
     * @inheritdoc
     */
    public function getLink()
    {
        $this->_data['{body}'] = $this->body;

        $this->_link = 'https://mail.google.com/mail/?view=cm&fs=1'
                    . '&su={title}'
                    . '&body={body}';

        return parent::getLink();
    }

    /**
     * @inheritdoc
     */
    protected function processShareData()
    {
        $this->title = static::encodeData($this->title);

        $this->body = strtr($this->bodyPattern, [
            '{url}'         => $this->url,
            '{description}' => $this->description,
            '{imageUrl}'    => $this->imageUrl
        ]);
        $this->body = static::encodeData($this->body);
    }
}
