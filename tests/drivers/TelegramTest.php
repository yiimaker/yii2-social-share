<?php

/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2021 Volodymyr Kupriienko
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\drivers;

use Codeception\Test\Unit;
use ymaker\social\share\base\AbstractDriver;
use ymaker\social\share\drivers\Telegram;

/**
 * Test case for [[Telegram]] driver.
 *
 * @property \ymaker\social\share\tests\UnitTester $tester
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @since 1.4.0
 */
class TelegramTest extends Unit
{
    public function testGetLinkWithMessage()
    {
        $message = 'this is message';
        $url = 'http://example.com';

        $driver = new Telegram(\compact('message', 'url'));

        $expected = 'https://telegram.me/share/url'
            . '?url=' . AbstractDriver::encodeData($url)
            . '&text=' . AbstractDriver::encodeData($message);

        static::assertEquals($expected, $driver->getLink());
    }
}
