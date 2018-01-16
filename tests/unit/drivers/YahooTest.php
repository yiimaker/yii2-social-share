<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\unit\drivers;

use ymaker\social\share\base\AbstractDriver;
use ymaker\social\share\drivers\Yahoo;

/**
 * Test case for [[Yahoo]] driver.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 2.0
 */
class YahooTest extends \Codeception\Test\Unit
{
    public function testGetLink()
    {
        $title = 'this is title';
        $description = 'this is description';
        $url = 'http://example.com';

        $driver = new Yahoo(compact('title', 'description', 'url'));

        $body = strtr('{description} - {url}', [
            '{description}' => $description,
            '{url}' => $url,
        ]);
        $expected = 'https://compose.mail.yahoo.com/'
            . '?subject=' . AbstractDriver::encodeData($title)
            . '&body=' . AbstractDriver::encodeData($body);

        $this->assertEquals($expected, $driver->getLink());
    }
}
