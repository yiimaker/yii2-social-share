<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2018 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\unit\drivers;

use Codeception\Test\Unit;
use ymaker\social\share\base\AbstractDriver;
use ymaker\social\share\drivers\Telegram;

/**
 * Test case for [[Telegram]] driver.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.4.0
 */
class TelegramTest extends Unit
{
    public function testGetLinkWithMessage()
    {
        $message = 'this is message';
        $url = 'http://example.com';

        $driver = new Telegram(compact('message', 'url'));

        $expected = 'https://telegram.me/share/url'
            . '?url=' . AbstractDriver::encodeData($url)
            . '&text=' . AbstractDriver::encodeData($message);

        self::assertEquals($expected, $driver->getLink());
    }
}
