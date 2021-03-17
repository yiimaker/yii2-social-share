<?php

/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2021 Volodymyr Kupriienko
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\unit\drivers;

use Codeception\Test\Unit;
use ymaker\social\share\base\AbstractDriver;
use ymaker\social\share\drivers\Gmail;

/**
 * Test case for [[Gmail]] driver.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @since 1.4.0
 */
class GmailTest extends Unit
{
    public function testGetLink()
    {
        $title = 'this is title';
        $description = 'this is description';
        $url = 'http://example.com';

        $driver = new Gmail(\compact('title', 'description', 'url'));

        $body = \strtr('{description} - {url}', [
            '{description}' => $description,
            '{url}' => $url,
        ]);
        $expected = 'https://mail.google.com/mail/?view=cm&fs=1'
            . '&su=' . AbstractDriver::encodeData($title)
            . '&body=' . AbstractDriver::encodeData($body);

        static::assertEquals($expected, $driver->getLink());
    }
}
