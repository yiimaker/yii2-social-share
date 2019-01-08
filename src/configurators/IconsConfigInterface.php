<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2019 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\configurators;

/**
 * Icons configuration interface.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @since 2.3
 */
interface IconsConfigInterface
{
    /**
     * Checks whether icons is enabled.
     *
     * @return bool
     */
    public function isIconsEnabled();

    /**
     * Checks whether default icons asset is enabled.
     *
     * @return bool
     */
    public function isDefaultAssetEnabled();

    /**
     * Returns icon selector for social network.
     *
     * @param string $socialNetwork
     *
     * @return string
     */
    public function getIconSelector($socialNetwork);
}
