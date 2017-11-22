<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\drivers;

use yii\base\InvalidConfigException;
use ymaker\social\share\base\Driver;

/**
 * Driver for Tumblr.
 * @link https://www.tumblr.com
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.4.0
 */
class Tumblr extends Driver
{
    const POST_TYPE_LINK    = 'link';
    const POST_TYPE_TEXT    = 'text';
    const POST_TYPE_QUOTE   = 'quote';
    const POST_TYPE_PHOTO   = 'photo';
    const POST_TYPE_VIDEO   = 'video';

    /**
     * @var string
     */
    public $postType = self::POST_TYPE_LINK;
    /**
     * @var string Share URL for type of post `link`.
     */
    public $shareUrl;
    /**
     * @var array Share photos list for type of post `photo`.
     */
    public $sharePhotos = [];
    /**
     * @var string Share URL or embed code for type of post `video`.
     */
    public $shareVideoUrl;
    /**
     * @var array
     */
    public $tags = [];


    /**
     * @inheritdoc
     */
    public function init()
    {
        $types = [
            self::POST_TYPE_LINK,
            self::POST_TYPE_TEXT,
            self::POST_TYPE_QUOTE,
            self::POST_TYPE_PHOTO,
            self::POST_TYPE_VIDEO,
        ];

        if (!in_array($this->postType, $types)) {
            throw new InvalidConfigException('Invalid post type: "' . $this->postType . '"');
        }
        if ($this->postType === self::POST_TYPE_PHOTO && empty($this->sharePhotos)) {
            throw new InvalidConfigException('Photos list cannot be blank!');
        }
        if ($this->postType === self::POST_TYPE_VIDEO && $this->shareVideoUrl === null) {
            throw new InvalidConfigException('You should to set share video URL or embed code!');
        }

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function getLink()
    {
        $this->_link = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl={url}';

        $this->addUrlParam('posttype', $this->postType);

        if ($this->postType === self::POST_TYPE_TEXT) {
            $this->addUrlParam('title', '{title}');
        } else {
            $this->addUrlParam('caption', '{title}');
        }

        switch ($this->postType) {
            case self::POST_TYPE_LINK:
                $url = $this->shareUrl === null
                    ? '{url}'
                    : $this->shareUrl;
                $this->addUrlParam('content', $url);
                break;
            case self::POST_TYPE_PHOTO:
                $this->addUrlParam('content', implode(',', $this->sharePhotos));
                break;
            case self::POST_TYPE_VIDEO:
                $this->addUrlParam('content', $this->shareVideoUrl);
                break;
            default:
                $this->addUrlParam('content', '{description}');
                break;
        }

        if (!empty($this->tags)) {
            $this->addUrlParam('tags', implode(',' , $this->tags));
        }

        return parent::getLink();
    }

    /**
     * Method should process the share data for current driver.
     */
    protected function processShareData()
    {
        $this->url = static::encodeData($this->url);
        $this->title = static::encodeData($this->title);
        $this->description = static::encodeData($this->description);

        switch ($this->postType) {
            case self::POST_TYPE_LINK:
                if (is_string($this->shareUrl)) {
                    $this->shareUrl = static::encodeData($this->shareUrl);
                }
                break;
            case self::POST_TYPE_PHOTO:
                $this->sharePhotos = static::encodeData($this->sharePhotos);
                break;
            case self::POST_TYPE_VIDEO:
                $this->shareVideoUrl = static::encodeData($this->shareVideoUrl);
                break;
        }

        if (!empty($this->tags)) {
            $this->tags = static::encodeData($this->tags);
        }
    }
}
