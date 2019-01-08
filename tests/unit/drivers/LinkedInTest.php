<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2019 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\unit\drivers;

use Codeception\Test\Unit;
use ymaker\social\share\base\AbstractDriver;
use ymaker\social\share\drivers\LinkedIn;

/**
 * Test case for [[LinkedIn]] driver.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.4.0
 */
class LinkedInTest extends Unit
{
    public function testGetLinkWithSiteName()
    {
        $siteName = 'http://test-site.com';
        $url = 'http://example.com';
        $title = 'this is title';
        $description = 'this is description';

        $driver = new LinkedIn(\compact('siteName', 'url', 'title', 'description'));

        $expected = 'https://www.linkedin.com/shareArticle?mini=true'
            . '&url=' . AbstractDriver::encodeData($url)
            . '&title=' . AbstractDriver::encodeData($title)
            . '&summary=' . AbstractDriver::encodeData($description)
            . '&source=' . AbstractDriver::encodeData($siteName);

        self::assertEquals($expected, $driver->getLink());
    }
}
