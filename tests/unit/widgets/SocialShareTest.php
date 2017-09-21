<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\unit\widgets;

use yii\base\InvalidConfigException;
use ymaker\social\share\widgets\SocialShare;

/**
 * Test case for  [[ymaker\social\share\widgets\SocialShare]].
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class SocialShareTest extends \Codeception\Test\Unit
{
    const DEFAULT_CONFIG_CONFIGURATOR_ID = 'defaultConfig';
    const DEFAULT_ICONS_CONFIGURATOR_ID = 'defaultIcons';

    public $vk = 'http://vk.com/share.php?url=test+url&amp;title=test+title&amp;description=test+description&amp;image=test+image+url';
    public $facebook = 'http://www.facebook.com/sharer.php?u=test+url';
    public $twitter = 'http://twitter.com/share?url=test+url&amp;text=test+description';
    public $googlePlus = 'https://plusone.google.com/_/+1/confirm?hl=en&amp;url=test+url';
    public $linkedIn = 'https://www.linkedin.com/shareArticle?mini=true&amp;url=test+url&amp;title=test+title&amp;summary=test+description';
    public $pinterest = 'https://www.pinterest.com/pin/create/link/?url=test+url&amp;media=test+image+url&amp;description=test+description';
    public $telegram = 'https://telegram.me/share/url?url=test+url';
    public $viber = 'viber://forward?text=test+url';
    public $whatsApp = 'whatsapp://send?text=test+url';
    public $gmail = "https://mail.google.com/mail/?view=cm&amp;fs=1&amp;su=test+title&amp;body=test description\ntest url";


    /**
     * Returns actual HTML code.
     *
     * @param string $configuratorId
     * @return string
     */
    protected function getActualHTML($configuratorId)
    {
        $widget = new SocialShare([
            'configuratorId' => $configuratorId,
            'url' => 'test url',
            'title' => 'test title',
            'description' => 'test description',
            'imageUrl' => 'test image url'
        ]);
        ob_start();
        $widget->run();
        $actualHTML = ob_get_contents();
        ob_end_clean();

        return $actualHTML;
    }

    public function testDefaultConfig()
    {
        $expectedHTML =
                    "<ul class=\"social-share\">"
                        . "<li><a href=\"$this->vk\" rel=\"nofollow\" target=\"_blank\">Vkontakte</a></li>"
                        . "<li><a href=\"$this->facebook\" rel=\"nofollow\" target=\"_blank\">Facebook</a></li>"
                        . "<li><a href=\"$this->twitter\" rel=\"nofollow\" target=\"_blank\">Twitter</a></li>"
                        . "<li><a href=\"$this->googlePlus\" rel=\"nofollow\" target=\"_blank\">Google Plus</a></li>"
                        . "<li><a href=\"$this->linkedIn\" rel=\"nofollow\" target=\"_blank\">Linkedin</a></li>"
                        . "<li><a href=\"$this->pinterest\" rel=\"nofollow\" target=\"_blank\">Pinterest</a></li>"
                        . "<li><a href=\"$this->telegram\" rel=\"nofollow\" target=\"_blank\">Telegram</a></li>"
                        . "<li><a href=\"$this->viber\" rel=\"nofollow\" target=\"_blank\">Viber</a></li>"
                        . "<li><a href=\"$this->whatsApp\" rel=\"nofollow\" target=\"_blank\">Whats App</a></li>"
                        . "<li><a href=\"$this->gmail\" rel=\"nofollow\" target=\"_blank\">Gmail</a></li>"
                    . "</ul>";
        $actualHTML = $this->getActualHTML(self::DEFAULT_CONFIG_CONFIGURATOR_ID);

        $this->assertEquals($expectedHTML, $actualHTML, 'Widget should render share links');
    }

    public function testDefaultIcons()
    {
        $expectedHTML =
            "<ul class=\"social-share\">"
            . "<li><a href=\"$this->vk\" rel=\"nofollow\" target=\"_blank\"><i class=\"si si-vk\"></i></a></li>"
            . "<li><a href=\"$this->facebook\" rel=\"nofollow\" target=\"_blank\"><i class=\"si si-facebook\"></i></a></li>"
            . "<li><a href=\"$this->twitter\" rel=\"nofollow\" target=\"_blank\"><i class=\"si si-twitter\"></i></a></li>"
            . "<li><a href=\"$this->googlePlus\" rel=\"nofollow\" target=\"_blank\"><i class=\"si si-google-plus\"></i></a></li>"
            . "<li><a href=\"$this->linkedIn\" rel=\"nofollow\" target=\"_blank\"><i class=\"si si-linkedin\"></i></a></li>"
            . "<li><a href=\"$this->pinterest\" rel=\"nofollow\" target=\"_blank\"><i class=\"si si-pinterest\"></i></a></li>"
            . "<li><a href=\"$this->telegram\" rel=\"nofollow\" target=\"_blank\"><i class=\"si si-telegram\"></i></a></li>"
            . "<li><a href=\"$this->viber\" rel=\"nofollow\" target=\"_blank\"><i class=\"\"></i></a></li>"
            . "<li><a href=\"$this->whatsApp\" rel=\"nofollow\" target=\"_blank\"><i class=\"si si-whatsapp\"></i></a></li>"
            . "<li><a href=\"$this->gmail\" rel=\"nofollow\" target=\"_blank\"><i class=\"si si-gmail\"></i></a></li>"
            . "</ul>";

        $actualHTML = $this->getActualHTML(self::DEFAULT_ICONS_CONFIGURATOR_ID);

        $this->assertEquals($expectedHTML, $actualHTML, 'Widget should render share links with default icons');
    }

    public function testInvalidConfigExceptionNotString()
    {
        $this->expectException(InvalidConfigException::class);

        SocialShare::widget(['configuratorId' => 123]);
    }

    public function testInvalidConfigException()
    {
        $this->expectException(InvalidConfigException::class);

        SocialShare::widget(['configuratorId' => 'not exists ID']);
    }
}
