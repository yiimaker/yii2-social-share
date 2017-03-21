<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\unit\widgets;

use ymaker\social\share\widgets\SocialShare;

/**
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class SocialShareTest extends \Codeception\Test\Unit
{
    const CONFIGURATOR_ID = 'socialShare';

    public function testWidget()
    {
        $widget = new SocialShare([
            'configuratorId' => self::CONFIGURATOR_ID,
            'url' => 'test url',
            'title' => 'test title',
            'description' => 'test description',
            'imageUrl' => 'test image url'
        ]);

        $vk = 'http://vk.com/share.php?url=test+url&amp;title=test+title&amp;description=test+description&amp;image=test+image+url';
        $facebook = 'http://www.facebook.com/sharer.php?u=test+url';
        $twitter = 'http://twitter.com/share?url=test+url&amp;text=test+description';
        $googlePlus = 'https://plusone.google.com/_/+1/confirm?hl=en&amp;url=test+url';
        $linkedIn = 'https://www.linkedin.com/shareArticle?mini=true&amp;url=test+url&amp;title=test+title&amp;summary=test+description';
        $pinterest = 'https://www.pinterest.com/pin/create/link/?url=test+url&amp;media=test+image+url&amp;description=test+description';
        $telegram = 'https://telegram.me/share/url?url=test+url';
        $viber = 'viber://forward?text=test+url';
        $whatsApp = 'whatsapp://send?text=test+url';
        $gmail = "https://mail.google.com/mail/?view=cm&amp;fs=1&amp;su=test+title&amp;body=test description\ntest url";

        $expectedHTML =
                    "<ul class=\"social-share\">"
                        . "<li><a href=\"$vk\" rel=\"nofollow\" target=\"_blank\">vkontakte</a></li>"
                        . "<li><a href=\"$facebook\" rel=\"nofollow\" target=\"_blank\">facebook</a></li>"
                        . "<li><a href=\"$twitter\" rel=\"nofollow\" target=\"_blank\">twitter</a></li>"
                        . "<li><a href=\"$googlePlus\" rel=\"nofollow\" target=\"_blank\">googlePlus</a></li>"
                        . "<li><a href=\"$linkedIn\" rel=\"nofollow\" target=\"_blank\">linkedIn</a></li>"
                        . "<li><a href=\"$pinterest\" rel=\"nofollow\" target=\"_blank\">pinterest</a></li>"
                        . "<li><a href=\"$telegram\" rel=\"nofollow\" target=\"_blank\">telegram</a></li>"
                        . "<li><a href=\"$viber\" rel=\"nofollow\" target=\"_blank\">viber</a></li>"
                        . "<li><a href=\"$whatsApp\" rel=\"nofollow\" target=\"_blank\">whatsApp</a></li>"
                        . "<li><a href=\"$gmail\" rel=\"nofollow\" target=\"_blank\">gmail</a></li>"
                    . "</ul>";

        ob_start();
        $widget->run();
        $actualHTML = ob_get_contents();
        ob_end_clean();

        $this->assertEquals($expectedHTML, $actualHTML, 'Widget should render share links');
    }
}
