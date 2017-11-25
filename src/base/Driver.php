<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\base;

use Yii;
use yii\base\Object;

/**
 * Base driver for social network definition classes.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
abstract class Driver extends Object
{
    /**
     * @var string Absolute URL to the page.
     */
    public $url;
    /**
     * @var string Title for share.
     */
    public $title;
    /**
     * @var string Description for share.
     */
    public $description;
    /**
     * @var string Absolute URL to the image for share.
     */
    public $imageUrl;

    /**
     * @var string
     */
    protected $_link;
    /**
     * @var array
     */
    protected $_metaTags = [];
    /**
     * @var array
     */
    protected $_data = [];


    /**
     * Prepare data data to insert into the link.
     */
    public function init()
    {
        $this->processShareData();
        $this->_data = [
            '{url}'         => $this->url,
            '{title}'       => $this->title,
            '{description}' => $this->description,
            '{imageUrl}'    => $this->imageUrl
        ];
    }

    /**
     * Encode data for URL.
     *
     * @param string|array $data
     * @return string|array
     */
    public static function encodeData($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = urlencode($value);
            }
            return $data;
        }
        return urlencode($data);
    }

    /**
     * Decode the encoded data.
     *
     * @param string $data
     * @return string
     */
    public static function decodeData($data)
    {
        return urldecode($data);
    }

    /**
     * Adds URL param to link.
     *
     * @param string $name Param name.
     * @param string $value Param value.
     * @since 1.4.0
     */
    protected function addUrlParam($name, $value)
    {
        $base = $name . '=' . $value;

        if (strpos($this->_link, '?') !== false) {
            $last = substr($this->_link, -1);
            if ($last === '?' || $last === '&') {
                $this->_link .= $base;
            } else {
                $this->_link .= '&' . $base;
            }
        } else {
            $this->_link .= '?' . $base;
        }
    }

    /**
     * This method should return a share link.
     *
     * @return string
     */
    public function getLink()
    {
        if (!empty($this->_metaTags)) {
            $data = [];
            foreach ($this->_data as $key => $value) {
                $data[$key] = static::decodeData($value);
            }

            foreach ($this->_metaTags as $metaTag) {
                $metaTag['content'] = strtr($metaTag['content'], $data);
                Yii::$app->getView()->registerMetaTag($metaTag);
            }
        }

        return strtr($this->_link, $this->_data);
    }

    /**
     * Method should process the share data for current driver.
     */
    abstract protected function processShareData();
}
