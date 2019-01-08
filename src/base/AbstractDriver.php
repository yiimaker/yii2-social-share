<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2019 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\base;

use Yii;
use yii\base\BaseObject;
use yii\helpers\ArrayHelper;

/**
 * Base driver for social network definition classes.
 *
 * @property-write $url
 * @property-write $title
 * @property-write $description
 * @property-write $imageUrl
 * @property-write $registerMetaTags
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
abstract class AbstractDriver extends BaseObject
{
    /**
     * Absolute URL to the page.
     *
     * @var string
     */
    protected $url;
    /**
     * Title for share.
     *
     * @var string
     */
    protected $title;
    /**
     * Description for share.
     *
     * @var string
     */
    protected $description;
    /**
     * Absolute URL to the image for share.
     *
     * @var string
     */
    protected $imageUrl;
    /**
     * Enable registering of drivers meta tags.
     *
     * @var bool
     *
     * @since 2.1
     */
    protected $registerMetaTags;

    /**
     * Contains data for URL.
     *
     * @var array
     */
    private $_data = [];


    /**
     * Method should process the share data for current driver.
     */
    abstract protected function processShareData();

    /**
     * Method should build template of share link.
     *
     * @return string
     *
     * @since 2.0
     */
    abstract protected function buildLink();

    /**
     * Encode data for URL.
     *
     * @param array|string $data
     *
     * @return array|string
     */
    public static function encodeData($data)
    {
        if (\is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = \urlencode($value);
            }

            return $data;
        }

        return \urlencode($data);
    }

    /**
     * Decode the encoded data.
     *
     * @param array|string $data
     *
     * @return array|string
     */
    public static function decodeData($data)
    {
        if (\is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = \urldecode($value);
            }

            return $data;
        }

        return \urldecode($data);
    }

    /**
     * @param string $url
     *
     * @since 2.0
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param string $title
     *
     * @since 2.0
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param string $description
     *
     * @since 2.0
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param string $imageUrl
     *
     * @since 2.0
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @param bool $register
     *
     * @since 2.1
     */
    public function setRegisterMetaTags($register)
    {
        $this->registerMetaTags = $register;
    }

    /**
     * Append value to data array.
     *
     * @param string    $key
     * @param string    $value
     * @param bool      $urlEncode
     *
     * @since 2.0
     */
    public function appendToData($key, $value, $urlEncode = true)
    {
        $key = '{' . $key . '}';
        $this->_data[$key] = $urlEncode ? static::encodeData($value) : $value;
    }

    /**
     * Prepare data data to insert into the link.
     */
    public function init()
    {
        $this->processShareData();

        $this->_data = ArrayHelper::merge([
            '{url}'         => $this->url,
            '{title}'       => $this->title,
            '{description}' => $this->description,
            '{imageUrl}'    => $this->imageUrl,
        ], $this->_data);

        $metaTags = $this->getMetaTags();

        if ($this->registerMetaTags && !empty($metaTags)) {
            $rawData = static::decodeData($this->_data);
            $view = Yii::$app->getView();

            foreach ($metaTags as $metaTag) {
                $metaTag['content'] = \strtr($metaTag['content'], $rawData);
                $view->registerMetaTag($metaTag, \md5(\implode(';', $metaTag)));
            }
        }
    }

    /**
     * Generates share link.
     *
     * @return string
     */
    final public function getLink()
    {
        return \strtr($this->buildLink(), $this->_data);
    }

    /**
     * Adds URL param to link.
     *
     * @param string $link
     * @param string $name  Param name.
     * @param string $value Param value.
     *
     * @since 1.4.0
     */
    final protected function addUrlParam(&$link, $name, $value)
    {
        $base = $name . '=' . $value;

        if (false !== \strpos($link, '?')) {
            $last = \substr($link, -1);

            if ('?' === $last || '&' === $last) {
                $link .= $base;
            } else {
                $link .= '&' . $base;
            }
        } else {
            $link .= '?' . $base;
        }
    }

    /**
     * Returns array of meta tags.
     *
     * @return array
     *
     * @since 2.0
     */
    protected function getMetaTags()
    {
        return [];
    }
}
