<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2018 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\unit\drivers;

use Codeception\Test\Unit;
use Yii;
use ymaker\social\share\base\AbstractDriver;
use ymaker\social\share\drivers\Twitter;

/**
 * Test case for [[Twitter]] driver.
 *
 * @property-read \UnitTester $tester
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.4.0
 */
class TwitterTest extends Unit
{
    public function testGetLinkWithAccount()
    {
        $account = 'tester';
        $url = 'http://example.com';
        $description = 'this is description';

        $driver = new Twitter(compact('account', 'url', 'description'));

        $expected = 'http://twitter.com/share'
            . '?url=' . AbstractDriver::encodeData($url)
            . '&text=' . AbstractDriver::encodeData($description)
            . '&via=' . AbstractDriver::encodeData($account);

        $this->assertEquals($expected, $driver->getLink());
    }

    public function testRegisteredMetaTags()
    {
        $title = 'this is title';
        $description = 'this is description';
        $imageUrl = 'this is image url';

        (new Twitter([
            'title' => $title,
            'description' => $description,
            'imageUrl' => $imageUrl,
            'registerMetaTags' => true,
        ]))->getLink();

        $expected = [
            $this->tester->metaTag('twitter:card', 'summary_large_image'),
            $this->tester->metaTag('twitter:title', $title),
            $this->tester->metaTag('twitter:description', $description),
            $this->tester->metaTag('twitter:image', $imageUrl),
        ];

        $this->assertEquals($expected, array_values(Yii::$app->getView()->metaTags));
    }
}
