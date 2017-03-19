<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\configurators;

use yii\base\Object;
use yii\helpers\ArrayHelper;

/**
 * Configurator for social network drivers
 *
 * @property array $socialNetworks
 * @property array $options
 * @property bool $enableSeoOptions
 * @property array $seoOptions
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
     * @var array
     */
    public $options = [];
    /**
     * @var bool
     */
    public $enableSeoOptions = true;
    /**
     * @var array
     */
    public $seoOptions = [];


    /**
     * @inheritdoc
     */
    public function init()
    {
        if (empty($this->seoOptions)) {
            $this->seoOptions = [
                'target' => '_blank',
                'rel'    => 'nofollow',
            ];
        }
    }

    /**
     * @inheritdoc
     */
    public function getSocialNetworks()
    {
        return $this->socialNetworks;
    }

    /**
     * @inheritdoc
     */
    public function getOptions()
    {
        return $this->enableSeoOptions
            ? ArrayHelper::merge($this->options, $this->seoOptions)
            : $this->options;
    }
}
