<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\unit\drivers;

use Yii;
use ymaker\social\share\drivers\Facebook;

/**
 * Test case for [[Facebook]] driver.
 *
 * @property-read \UnitTester $tester
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.4.0
 */
class FacebookTest extends \Codeception\Test\Unit
{
    public function testRegisteredMetaTags()
    {
        $url = 'http://example.com';
        $title = 'this is title';
        $description = 'this is description';
        $imageUrl = 'http://example.com/image.jpg';

        (new Facebook(compact('url', 'title', 'description', 'imageUrl')))->getLink();

        $expected = [
            $this->tester->openGraphMetaTag('og:url', $url),
            $this->tester->openGraphMetaTag('og:type', 'website'),
            $this->tester->openGraphMetaTag('og:title', $title),
            $this->tester->openGraphMetaTag('og:description', $description),
            $this->tester->openGraphMetaTag('og:image', $imageUrl),
        ];

        $this->assertEquals($expected, Yii::$app->getView()->metaTags);
    }
}
