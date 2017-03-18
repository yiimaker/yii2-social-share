<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\base;

use yii\base\Object;

/**
 * Base driver for social network definition classes
 *
 * @property string $url
 * @property string $title
 * @property string $description
 * @property string $imageUrl
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class Driver extends Object
{
    /**
     * @var string Absolute URL to the page
     */
    public $url;
    /**
     * @var string Title for share
     */
    public $title;
    /**
     * @var string Description for share
     */
    public $description;
    /**
     * @var string Absolute URL to the image for share
     */
    public $imageUrl;

    /**
     * @var string
     */
    protected $_link;


    /**
     * This method should return a share link
     * @return string
     */
    public function getLink()
    {
        return strtr($this->_link, [
            '{url}'         => $this->url,
            '{title}'       => $this->title,
            '{description}' => $this->description,
            '{imageUrl}'    => $this->imageUrl
        ]);
    }
}
