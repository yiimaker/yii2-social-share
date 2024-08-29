<?php

/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2021 Volodymyr Kupriienko
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\widgets;

use Codeception\Test\Unit;
use Yii;
use yii\base\InvalidConfigException;
use ymaker\social\share\widgets\SocialShare;

/**
 * Test case for  [[ymaker\social\share\widgets\SocialShare]].
 *
 * @property \ymaker\social\share\tests\UnitTester $tester
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @since 1.0
 */
class SocialShareTest extends Unit
{
    const DEFAULT_CONFIG_CONFIGURATOR_ID = 'defaultConfig';
    const DEFAULT_ICONS_CONFIGURATOR_ID = 'defaultIcons';

    private $facebook = 'http://www.facebook.com/sharer.php?u=test+url';
    private $twitter = 'http://twitter.com/share?url=test+url&amp;text=test+description';
    private $googlePlus = 'https://plusone.google.com/_/+1/confirm?hl=en&amp;url=test+url';
    private $linkedIn = 'https://www.linkedin.com/shareArticle?mini=true&amp;url=test+url&amp;title=test+title&amp;summary=test+description';
    private $pinterest = 'https://www.pinterest.com/pin/create/link/?url=test+url&amp;media=test+image+url&amp;description=test+description';
    private $telegram = 'https://telegram.me/share/url?url=test+url';
    private $viber = 'viber://forward?text=test+url';
    private $whatsApp = 'whatsapp://send?text=test+url';
    private $gmail = 'https://mail.google.com/mail/?view=cm&amp;fs=1&amp;su=test+title&amp;body=test+description+-+test+url';
    private $tumblr = 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=test+url&amp;posttype=link&amp;caption=test+title&amp;content=test+url';
    private $yahoo = 'https://compose.mail.yahoo.com/?subject=test+title&amp;body=test+description+-+test+url';
    private $trello = 'https://trello.com/add-card?url=test+url&amp;name=test+title';

    public function testInvalidConfigException()
    {
        $this->expectException(InvalidConfigException::class);

        SocialShare::widget(['configurator' => 'not exists ID']);
    }

    public function testDefaultConfig()
    {
        $expectedHTML =
                    '<!--noindex-->'
                    . '<ul class="social-share">'
                        . "<li><a href=\"$this->facebook\" rel=\"noopener\" target=\"_blank\">Facebook</a></li>"
                        . "<li><a href=\"$this->twitter\" rel=\"noopener\" target=\"_blank\">Twitter</a></li>"
                        . "<li><a href=\"$this->googlePlus\" rel=\"noopener\" target=\"_blank\">Google Plus</a></li>"
                        . "<li><a href=\"$this->linkedIn\" rel=\"noopener\" target=\"_blank\">Linkedin</a></li>"
                        . "<li><a href=\"$this->pinterest\" rel=\"noopener\" target=\"_blank\">Pinterest</a></li>"
                        . "<li><a href=\"$this->telegram\" rel=\"noopener\" target=\"_blank\">Telegram</a></li>"
                        . "<li><a href=\"$this->viber\" rel=\"noopener\" target=\"_blank\">Viber</a></li>"
                        . "<li><a href=\"$this->whatsApp\" rel=\"noopener\" target=\"_blank\">Whats App</a></li>"
                        . "<li><a href=\"$this->gmail\" rel=\"noopener\" target=\"_blank\">Gmail</a></li>"
                        . "<li><a href=\"$this->tumblr\" rel=\"noopener\" target=\"_blank\">Tumblr</a></li>"
                        . "<li><a href=\"$this->yahoo\" rel=\"noopener\" target=\"_blank\">Yahoo</a></li>"
                        . "<li><a href=\"$this->trello\" rel=\"noopener\" target=\"_blank\">Trello</a></li>"
                    . '</ul>'
                    . '<!--/noindex-->';
        $actualHTML = $this->getActualHTML(self::DEFAULT_CONFIG_CONFIGURATOR_ID);

        static::assertEquals($expectedHTML, $actualHTML, 'Widget should render share links');

        $expectedMetaTags = [
            $this->tester->openGraphMetaTag('og:url', 'test url'),
            $this->tester->openGraphMetaTag('og:type', 'website'),
            $this->tester->openGraphMetaTag('og:title', 'test title'),
            $this->tester->openGraphMetaTag('og:description', 'test description'),
            $this->tester->openGraphMetaTag('og:image', 'test image url'),
            $this->tester->metaTag('twitter:card', 'summary_large_image'),
            $this->tester->metaTag('twitter:title', 'test title'),
            $this->tester->metaTag('twitter:description', 'test description'),
            $this->tester->metaTag('twitter:image', 'test image url'),
        ];

        static::assertEquals($expectedMetaTags, \array_values(Yii::$app->getView()->metaTags));
    }

    public function testDefaultIcons()
    {
        $expectedHTML =
            '<!--noindex-->'
            . '<ul class="social-share">'
                . "<li><a href=\"$this->facebook\" rel=\"noopener\" target=\"_blank\"><i class=\"si si-facebook\"></i></a></li>"
                . "<li><a href=\"$this->twitter\" rel=\"noopener\" target=\"_blank\"><i class=\"si si-twitter\"></i></a></li>"
                . "<li><a href=\"$this->googlePlus\" rel=\"noopener\" target=\"_blank\"><i class=\"si si-google-plus\"></i></a></li>"
                . "<li><a href=\"$this->linkedIn\" rel=\"noopener\" target=\"_blank\"><i class=\"si si-linkedin\"></i></a></li>"
                . "<li><a href=\"$this->pinterest\" rel=\"noopener\" target=\"_blank\"><i class=\"si si-pinterest\"></i></a></li>"
                . "<li><a href=\"$this->telegram\" rel=\"noopener\" target=\"_blank\"><i class=\"si si-telegram\"></i></a></li>"
                . "<li><a href=\"$this->viber\" rel=\"noopener\" target=\"_blank\"><i class=\"\"></i></a></li>"
                . "<li><a href=\"$this->whatsApp\" rel=\"noopener\" target=\"_blank\"><i class=\"si si-whatsapp\"></i></a></li>"
                . "<li><a href=\"$this->gmail\" rel=\"noopener\" target=\"_blank\"><i class=\"si si-gmail\"></i></a></li>"
                . "<li><a href=\"$this->tumblr\" rel=\"noopener\" target=\"_blank\"><i class=\"si si-tumblr\"></i></a></li>"
                . "<li><a href=\"$this->yahoo\" rel=\"noopener\" target=\"_blank\"><i class=\"si si-yahoo\"></i></a></li>"
                . "<li><a href=\"$this->trello\" rel=\"noopener\" target=\"_blank\"><i class=\"si si-trello\"></i></a></li>"
            . '</ul>'
            . '<!--/noindex-->';

        $actualHTML = $this->getActualHTML(self::DEFAULT_ICONS_CONFIGURATOR_ID);

        static::assertEquals($expectedHTML, $actualHTML, 'Widget should render share links with default icons');
    }

    public function testDisableMetaTags()
    {
        SocialShare::widget([
            'configurator' => 'disableMetaTags',
            'url' => 'test',
        ]);

        static::assertSame([], Yii::$app->getView()->metaTags);
    }

    /**
     * Returns actual HTML code.
     *
     * @param string $configurator
     *
     * @return string
     */
    private function getActualHTML($configurator)
    {
        $widget = new SocialShare([
            'configurator' => $configurator,
            'url' => 'test url',
            'title' => 'test title',
            'description' => 'test description',
            'imageUrl' => 'test image url',
        ]);
        \ob_start();
        $widget->run();
        $actualHTML = \ob_get_contents();
        \ob_end_clean();

        return $actualHTML;
    }
}
