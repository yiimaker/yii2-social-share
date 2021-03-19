<?php

/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2021 Volodymyr Kupriienko
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\drivers;

use Codeception\Test\Unit;
use yii\base\InvalidConfigException;
use ymaker\social\share\base\AbstractDriver;
use ymaker\social\share\drivers\Tumblr;

/**
 * Test case for [[Tumblr]] driver.
 *
 * @property \ymaker\social\share\tests\UnitTester $tester
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @since 1.4.0
 */
class TumblrTest extends Unit
{
    public function testInitExceptionInvalidPostType()
    {
        $this->expectException(InvalidConfigException::class);

        new Tumblr(['postType' => 'not exist']);
    }

    public function testInitExceptionEmptyPhotosList()
    {
        $this->expectException(InvalidConfigException::class);

        new Tumblr([
            'postType' => Tumblr::POST_TYPE_PHOTO,
            'sharePhotos' => [],
        ]);
    }

    public function testInitExceptionEmptyVideoShareUrl()
    {
        $this->expectException(InvalidConfigException::class);

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

        $driver = new Tumblr(\compact('tags', 'url', 'title'));

        $expected = 'https://www.tumblr.com/widgets/share/tool'
            . '?canonicalUrl=' . AbstractDriver::encodeData($url)
            . '&posttype=' . Tumblr::POST_TYPE_LINK
            . '&caption=' . AbstractDriver::encodeData($title)
            . '&content=' . AbstractDriver::encodeData($url)
            . '&tags=' . AbstractDriver::encodeData(\implode(',', $tags));

        static::assertEquals($expected, $driver->getLink());
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
            . '?canonicalUrl=' . AbstractDriver::encodeData($url)
            . '&posttype=' . Tumblr::POST_TYPE_LINK
            . '&caption=' . AbstractDriver::encodeData($title)
            . '&content=' . AbstractDriver::encodeData($shareUrl);

        static::assertEquals($expected, $driver->getLink());
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
            . '?canonicalUrl=' . AbstractDriver::encodeData($url)
            . '&posttype=' . Tumblr::POST_TYPE_TEXT
            . '&title=' . AbstractDriver::encodeData($title)
            . '&content=' . AbstractDriver::encodeData($description);

        static::assertEquals($expected, $driver->getLink());
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
            . '?canonicalUrl=' . AbstractDriver::encodeData($url)
            . '&posttype=' . Tumblr::POST_TYPE_QUOTE
            . '&caption=' . AbstractDriver::encodeData($title)
            . '&content=' . AbstractDriver::encodeData($description);

        static::assertEquals($expected, $driver->getLink());
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
            . '?canonicalUrl=' . AbstractDriver::encodeData($url)
            . '&posttype=' . Tumblr::POST_TYPE_PHOTO
            . '&caption=' . AbstractDriver::encodeData($title)
            . '&content=' . \implode(',', $sharePhotos);

        static::assertEquals($expected, $driver->getLink());
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
            . '?canonicalUrl=' . AbstractDriver::encodeData($url)
            . '&posttype=' . Tumblr::POST_TYPE_VIDEO
            . '&caption=' . AbstractDriver::encodeData($title)
            . '&content=' . AbstractDriver::encodeData($shareVideoUrl);

        static::assertEquals($expected, $driver->getLink());
    }
}
