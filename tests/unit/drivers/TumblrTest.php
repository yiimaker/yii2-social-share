<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\unit\drivers;

use ymaker\social\share\base\Driver;
use ymaker\social\share\drivers\Tumblr;

/**
 * Test case for [[Tumblr]] driver.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.4.0
 */
class TumblrTest extends \Codeception\Test\Unit
{
    /**
     * @expectedException \yii\base\InvalidConfigException
     */
    public function testInitExceptionInvalidPostType()
    {
        new Tumblr(['postType' => 'not exist']);
    }

    /**
     * @expectedException \yii\base\InvalidConfigException
     */
    public function testInitExceptionEmptyPhotosList()
    {
        new Tumblr([
            'postType' => Tumblr::POST_TYPE_PHOTO,
            'sharePhotos' => [],
        ]);
    }

    /**
     * @expectedException \yii\base\InvalidConfigException
     */
    public function testInitExceptionEmptyVideoShareUrl()
    {
        new Tumblr([
            'postType' => Tumblr::POST_TYPE_VIDEO,
            'shareVideoUrl' => null,
        ]);
    }

    public function testGetLinkWithTags()
    {
        $tags = ['this', 'is', 'test'];
        $url = 'http://example.com';
        $title = 'test title';

        $driver = new Tumblr([
            'tags' => $tags,
            'url' => $url,
            'title' => $title,
        ]);

        $expected = 'https://www.tumblr.com/widgets/share/tool'
            . '?canonicalUrl=' . Driver::encodeData($url)
            . '&posttype=' . Tumblr::POST_TYPE_LINK
            . '&caption=' . Driver::encodeData($title)
            . '&content=' . Driver::encodeData($url)
            . '&tags=' . implode(',', $tags);

        $this->assertEquals($expected, $driver->getLink());
    }

    public function testGetLinkWithPostTypeLink()
    {
        $shareUrl = 'http://test.com';
        $url = 'http://example.com';
        $title = 'test title';

        $driver = new Tumblr([
            'postType' => Tumblr::POST_TYPE_LINK,
            'shareUrl' => $shareUrl,
            'url' => $url,
            'title' => $title,
        ]);

        $expected = 'https://www.tumblr.com/widgets/share/tool'
            . '?canonicalUrl=' . Driver::encodeData($url)
            . '&posttype=' . Tumblr::POST_TYPE_LINK
            . '&caption=' . Driver::encodeData($title)
            . '&content=' . Driver::encodeData($shareUrl);

        $this->assertEquals($expected, $driver->getLink());
    }

    public function testGetLinkWithPostTypeText()
    {
        $url = 'http://example.com';
        $title = 'test title';
        $description = 'test description';

        $driver = new Tumblr([
            'postType' => Tumblr::POST_TYPE_TEXT,
            'url' => $url,
            'title' => $title,
            'description' => $description,
        ]);

        $expected = 'https://www.tumblr.com/widgets/share/tool'
            . '?canonicalUrl=' . Driver::encodeData($url)
            . '&posttype=' . Tumblr::POST_TYPE_TEXT
            . '&title=' . Driver::encodeData($title)
            . '&content=' . Driver::encodeData($description);

        $this->assertEquals($expected, $driver->getLink());
    }

    public function testGetLinkWithPostTypeQuote()
    {
        $url = 'http://example.com';
        $title = 'test title';
        $description = 'test description';

        $driver = new Tumblr([
            'postType' => Tumblr::POST_TYPE_QUOTE,
            'url' => $url,
            'title' => $title,
            'description' => $description,
        ]);

        $expected = 'https://www.tumblr.com/widgets/share/tool'
            . '?canonicalUrl=' . Driver::encodeData($url)
            . '&posttype=' . Tumblr::POST_TYPE_QUOTE
            . '&caption=' . Driver::encodeData($title)
            . '&content=' . Driver::encodeData($description);

        $this->assertEquals($expected, $driver->getLink());
    }

    public function testGetLinkWithPostTypePhoto()
    {
        $sharePhotos = ['photo1'];
        $url = 'http://example.com';
        $title = 'test title';

        $driver = new Tumblr([
            'postType' => Tumblr::POST_TYPE_PHOTO,
            'sharePhotos' => $sharePhotos,
            'url' => $url,
            'title' => $title,
        ]);

        $expected = 'https://www.tumblr.com/widgets/share/tool'
            . '?canonicalUrl=' . Driver::encodeData($url)
            . '&posttype=' . Tumblr::POST_TYPE_PHOTO
            . '&caption=' . Driver::encodeData($title)
            . '&content=' . implode(',', $sharePhotos);

        $this->assertEquals($expected, $driver->getLink());
    }

    public function testGetLinkWithPostTypeVideo()
    {
        $shareVideoUrl = 'http://youtube.com/some-video';
        $url = 'http://example.com';
        $title = 'test title';

        $driver = new Tumblr([
            'postType' => Tumblr::POST_TYPE_VIDEO,
            'shareVideoUrl' => $shareVideoUrl,
            'url' => $url,
            'title' => $title,
        ]);

        $expected = 'https://www.tumblr.com/widgets/share/tool'
            . '?canonicalUrl=' . Driver::encodeData($url)
            . '&posttype=' . Tumblr::POST_TYPE_VIDEO
            . '&caption=' . Driver::encodeData($title)
            . '&content=' . Driver::encodeData($shareVideoUrl);

        $this->assertEquals($expected, $driver->getLink());
    }
}
