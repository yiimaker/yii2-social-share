<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace Helper;

/**
 * Helper for unit tests.
 * @since 1.4.0
 */
class Unit extends \Codeception\Module
{
    /**
     * Creates HTML meta tag.
     *
     * @param string $name
     * @param string $content
     * @return string
     */
    public function metaTag($name, $content)
    {
        return "<meta name=\"$name\" content=\"$content\">";
    }
}
