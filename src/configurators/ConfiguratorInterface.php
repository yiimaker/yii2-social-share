<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\configurators;

/**
 * Interface for configurators of social network drivers
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
interface ConfiguratorInterface
{
    /**
     * This method should returns a array with config
     * for social network drivers
     * @return array
     */
    public function getSocialNetworks();
}
