<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\configurators;

use yii\base\BaseObject;
use yii\helpers\ArrayHelper;
use ymaker\social\share\drivers\Facebook;
use ymaker\social\share\drivers\GooglePlus;
use ymaker\social\share\drivers\LinkedIn;
use ymaker\social\share\drivers\Gmail;
use ymaker\social\share\drivers\WhatsApp;
use ymaker\social\share\drivers\Telegram;
use ymaker\social\share\drivers\Pinterest;
use ymaker\social\share\drivers\Tumblr;
use ymaker\social\share\drivers\Twitter;
use ymaker\social\share\drivers\Vkontakte;
use ymaker\social\share\drivers\Yahoo;
use ymaker\social\share\drivers\Odnoklassniki;

/**
 * Configurator for social network drivers.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class Configurator extends BaseObject implements ConfiguratorInterface
{
    /**
     * Configuration of social network drivers.
     *
     * @var array
     */
    public $socialNetworks = [];
    /**
     * CSS options for share links.
     *
     * @var array
     */
    public $options = [];
    /**
     * Enable SEO options for share links.
     *
     * @var bool
     */
    public $enableSeoOptions = true;
    /**
     * HTML attributes from this option will be applied if `enableSeoOptions` is true.
     *
     * @var array
     */
    public $seoOptions = [];
    /**
     * Enable default icons instead labels for social networks.
     *
     * @var bool
     */
    public $enableDefaultIcons = false;
    /**
     * Configuration of icons for social network drivers.
     *
     * @var array
     */
    public $icons = [];

    /**
     * @var array
     */
    private $_defaultIconsMap = [
        Vkontakte::class     => 'si si-vk',
        Facebook::class      => 'si si-facebook',
        Twitter::class       => 'si si-twitter',
        GooglePlus::class    => 'si si-google-plus',
        LinkedIn::class      => 'si si-linkedin',
        Pinterest::class     => 'si si-pinterest',
        Telegram::class      => 'si si-telegram',
        WhatsApp::class      => 'si si-whatsapp',
        Gmail::class         => 'si si-gmail',
        Tumblr::class        => 'si si-tumblr',
        Yahoo::class         => 'si si-yahoo',
        Odnoklassniki::class => 'si si-odnoklassniki',
    ];


    /**
     * Set default values for special link options.
     */
    public function init()
    {
        if (empty($this->seoOptions)) {
            $this->seoOptions = [
                'target' => '_blank',
                'rel'    => 'noopener',
            ];
        }
        if ($this->enableDefaultIcons) {
            $this->icons = ArrayHelper::merge($this->_defaultIconsMap, $this->icons);
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

    /**
     * Returns icon selector by driver name.
     *
     * @param string $driverName
     *
     * @return string
     */
    public function getIconSelector($driverName)
    {
        return isset($this->icons[$driverName]) ? $this->icons[$driverName] : '';
    }
}
