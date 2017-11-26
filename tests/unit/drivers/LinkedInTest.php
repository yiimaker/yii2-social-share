<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\unit\drivers;

use ymaker\social\share\base\Driver;
use ymaker\social\share\drivers\LinkedIn;

/**
 * Test case for [[LinkedIn]] driver.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.4.0
 */
class LinkedInTest extends \Codeception\Test\Unit
{
    public function testGetLinkWithSiteName()
    {
        $siteName = 'http://test-site.com';
        $url = 'http://example.com';
        $title = 'this is title';
        $description = 'this is description';

        $driver = new LinkedIn(compact('siteName', 'url', 'title', 'description'));

        $expected = 'https://www.linkedin.com/shareArticle?mini=true'
            . '&url=' . Driver::encodeData($url)
            . '&title=' . Driver::encodeData($title)
            . '&summary=' . Driver::encodeData($description)
            . '&source=' . Driver::encodeData($siteName);

        $this->assertEquals($expected, $driver->getLink());
    }
}
