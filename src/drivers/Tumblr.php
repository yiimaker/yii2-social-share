<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2019 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\drivers;

use yii\base\InvalidConfigException;
use ymaker\social\share\base\AbstractDriver;

/**
 * Driver for Tumblr.
 *
 * @link https://www.tumblr.com
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.4.0
 */
class Tumblr extends AbstractDriver
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
     * Share URL for type of post `link`.
     *
     * @var string
     */
    public $shareUrl;
    /**
     * Share photos list for type of post `photo`.
     *
     * @var array|string
     */
    public $sharePhotos = [];
    /**
     * Share URL or embed code for type of post `video`.
     *
     * @var string
     */
    public $shareVideoUrl;
    /**
     * @var array|string
     */
    public $tags = [];


    /**
     * {@inheritdoc}
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

        if (!\in_array($this->postType, $types)) {
            throw new InvalidConfigException('Invalid post type: "' . $this->postType . '"');
        }

        if (self::POST_TYPE_PHOTO === $this->postType && empty($this->sharePhotos)) {
            throw new InvalidConfigException('Photos list cannot be blank!');
        }

        if (self::POST_TYPE_VIDEO === $this->postType && null === $this->shareVideoUrl) {
            throw new InvalidConfigException('You should to set share video URL or embed code!');
        }

        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    protected function processShareData()
    {
        $this->url = static::encodeData($this->url);
        $this->title = static::encodeData($this->title);
        $this->description = static::encodeData($this->description);

        switch ($this->postType) {
            case self::POST_TYPE_LINK:
                $this->appendToData(
                    'content',
                    null === $this->shareUrl ? $this->url : $this->shareUrl,
                    null !== $this->shareUrl
                );
                break;
            case self::POST_TYPE_PHOTO:
                $this->appendToData('content', \implode(',', $this->sharePhotos));
                break;
            case self::POST_TYPE_VIDEO:
                $this->appendToData('content', $this->shareVideoUrl);
                break;
            default:
                $this->appendToData('content', $this->description, false);
                break;
        }

        if (!empty($this->tags)) {
            $this->appendToData('tags', \implode(',', $this->tags));
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function buildLink()
    {
        $link = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl={url}';

        $this->addUrlParam($link, 'posttype', $this->postType);

        if (self::POST_TYPE_TEXT === $this->postType) {
            $this->addUrlParam($link, 'title', '{title}');
        } else {
            $this->addUrlParam($link, 'caption', '{title}');
        }

        $this->addUrlParam($link, 'content', '{content}');

        if (!empty($this->tags)) {
            $this->addUrlParam($link, 'tags', '{tags}');
        }

        return $link;
    }
}
