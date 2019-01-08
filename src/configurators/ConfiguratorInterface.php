<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2019 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\configurators;

/**
 * Interface of configurators of social network drivers.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
interface ConfiguratorInterface
{
    /**
     * Returns array with config for social network drivers.
     *
     * @return array
     */
    public function getSocialNetworks();

    /**
     * Returns array with HTML options for share links.
     *
     * @return array
     */
    public function getOptions();

    /**
     * Checks whether driver can register own meta tags in the view.
     *
     * @return bool
     *
     * @since 2.3
     */
    public function canRegisterMetaTags();
}
