<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\unit\drivers;

use ymaker\social\share\base\Driver;
use ymaker\social\share\drivers\other\Telegram;

/**
 * Test case for [[Telegram]] driver.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.4.0
 */
class TelegramTest extends \Codeception\Test\Unit
{
    public function testGetLinkWithMessage()
    {
        $message = 'this is message';
        $url = 'http://example.com';

        $driver = new Telegram(compact('message', 'url'));

        $expected = 'https://telegram.me/share/url'
            . '?url=' . Driver::encodeData($url)
            . '&text=' . Driver::encodeData($message);

        $this->assertEquals($expected, $driver->getLink());
    }
}
