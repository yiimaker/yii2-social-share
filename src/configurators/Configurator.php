<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\configurators;

use yii\base\Object;
use yii\helpers\ArrayHelper;

use ymaker\social\share\drivers\Facebook;
use ymaker\social\share\drivers\GooglePlus;
use ymaker\social\share\drivers\LinkedIn;
use ymaker\social\share\drivers\other\Gmail;
use ymaker\social\share\drivers\other\mobile\WhatsApp;
use ymaker\social\share\drivers\other\Telegram;
use ymaker\social\share\drivers\Pinterest;
use ymaker\social\share\drivers\Twitter;
use ymaker\social\share\drivers\Vkontakte;

/**
 * Configurator for social network drivers
 *
 * @property array $socialNetworks
 * @property array $options
 * @property bool $enableSeoOptions
 * @property array $seoOptions
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
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
     * @var bool
     */
    public $enableDefaultIcons = false;
    /**
     * @var array
     */
    public $icons = [];


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
        if ($this->enableDefaultIcons) {
            $this->icons = ArrayHelper::merge($this->getDefaultIcons(), $this->icons);
        }
    }

    /**
     * Default icons for social networks
     */
    private function getDefaultIcons()
    {
        return [
            Vkontakte::class    => 'si si-vk',
            Facebook::class     => 'si si-facebook',
            Twitter::class      => 'si si-twitter',
            GooglePlus::class   => 'si si-google-plus',
            LinkedIn::class     => 'si si-linkedin',
            Pinterest::class    => 'si si-pinterest',
            Telegram::class     => 'si si-telegram',
            WhatsApp::class     => 'si si-whatsapp',
            Gmail::class        => 'si si-gmail'
        ];
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

    /**
     * Get icon selector by driver name
     *
     * @param string $driverName
     * @return string
     */
    public function getIconSelector($driverName)
    {
        return isset($this->icons[$driverName]) ? $this->icons[$driverName] : '';
    }
}
