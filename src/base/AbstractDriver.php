<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2018 Yii Maker
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
    abstract protected function processShareData(): void;

    /**
     * Method should build template of share link.
     *
     * @return string
     *
     * @since 2.0
     */
    abstract protected function buildLink(): string;

    /**
     * Encode data for URL.
     *
     * @param string|array $data
     *
     * @return string|array
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
     * @param string|array $data
     *
     * @return string|array
     */
    public static function decodeData($data)
    {
        if (\is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = \urldecode($value);
            }

            return $data;
        }

        return urldecode($data);
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    public function setRegisterMetaTags(bool $register): void
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
    public function appendToData(string $key, string $value, bool $urlEncode = true): void
    {
        $key = \sprintf('{%s}', $key);
        $this->_data[$key] = $urlEncode ? static::encodeData($value) : $value;
    }

    /**
     * Prepare data data to insert into the link.
     */
    public function init(): void
    {
        $this->processShareData();

        $this->_data = ArrayHelper::merge([
            '{url}'         => $this->url,
            '{title}'       => $this->title,
            '{description}' => $this->description,
            '{imageUrl}'    => $this->imageUrl
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
    final public function getLink(): string
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
    final protected function addUrlParam(string &$link, string $name, string $value): void
    {
        $base = $name . '=' . $value;

        if (\strpos($link, '?') !== false) {
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
    protected function getMetaTags(): array
    {
        return [];
    }
}
