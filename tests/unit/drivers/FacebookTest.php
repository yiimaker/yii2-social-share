<?php

/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2021 Volodymyr Kupriienko
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\unit\drivers;

use Codeception\Test\Unit;
use Yii;
use ymaker\social\share\drivers\Facebook;

/**
 * Test case for [[Facebook]] driver.
 *
 * @property \UnitTester $tester
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @since 1.4.0
 */
class FacebookTest extends Unit
{
    public function testRegisteredMetaTags()
    {
        $url = 'http://example.com';
        $title = 'this is title';
        $description = 'this is description';
        $imageUrl = 'http://example.com/image.jpg';

        (new Facebook([
            'url' => $url,
            'title' => $title,
            'description' => $description,
            'imageUrl' => $imageUrl,
            'registerMetaTags' => true,
        ]))->getLink();

        $expected = [
            $this->tester->openGraphMetaTag('og:url', $url),
            $this->tester->openGraphMetaTag('og:type', 'website'),
            $this->tester->openGraphMetaTag('og:title', $title),
            $this->tester->openGraphMetaTag('og:description', $description),
            $this->tester->openGraphMetaTag('og:image', $imageUrl),
        ];

        static::assertEquals($expected, \array_values(Yii::$app->getView()->metaTags));
    }
}
