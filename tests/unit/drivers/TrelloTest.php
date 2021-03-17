<?php

/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2021 Volodymyr Kupriienko
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\unit\drivers;

use Codeception\Test\Unit;
use Yii;
use ymaker\social\share\drivers\Trello;

/**
 * Test case for [[Trello]] driver.
 *
 * @property \UnitTester $tester
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @since 2.2
 */
class TrelloTest extends Unit
{
    public function testRegisteredMetaTags()
    {
        $description = 'this is description';

        (new Trello(['description' => $description, 'registerMetaTags' => true]))->getLink();

        $expected = [
            $this->tester->openGraphMetaTag('og:description', $description),
        ];

        static::assertEquals($expected, \array_values(Yii::$app->getView()->metaTags));
    }
}
