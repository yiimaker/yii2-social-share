<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\configurators;

use yii\base\Object;

/**
 * Configurator for social network drivers
 *
 * @property array $socialNetworks
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
class Configurator extends Object implements ConfiguratorInterface
{
    /**
     * @var array
     */
    public $socialNetworks = [];


    /**
     * @inheritdoc
     */
    public function getSocialNetworks()
    {
        return $this->socialNetworks;
    }
}
