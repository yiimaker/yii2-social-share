<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\widgets;

use Yii;
use yii\base\Widget;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\Url;
use ymaker\social\share\assets\SocialIconsAsset;
use ymaker\social\share\configurators\Configurator;
use ymaker\social\share\configurators\ConfiguratorInterface;

/**
 * Widget for rendering the share links.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class SocialShare extends Widget
{
    /**
     * @var string ID of configurator component.
     */
    public $configuratorId;
    /**
     * @var string Absolute URL to the page.
     */
    public $url = '';
    /**
     * @var string Title for share.
     */
    public $title = '';
    /**
     * @var string Description for share.
     */
    public $description = '';
    /**
     * @var string Absolute URL to the image for share.
     */
    public $imageUrl = '';
    /**
     * @var array Special properties for specific driver.
     * @since 1.4.0
     */
    public $driverProperties = [];
    /**
     * @var string Name of the wrapper tag.
     */
    public $wrapperTag = 'ul';
    /**
     * @var array HTML options for wrapper tag.
     */
    public $wrapperOptions = ['class' => 'social-share'];
    /**
     * @var bool|string Name of the wrapper tag for link.
     * Set `false` value if you don't want using wrapper for link.
     */
    public $linkWrapperTag = 'li';
    /**
     * @var array HTML options for link wrapper tag.
     */
    public $linkWrapperOptions = [];

    /**
     * @var \ymaker\social\share\configurators\ConfiguratorInterface
     */
    protected $_configurator;


    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->_configurator = Instance::ensure($this->configuratorId, ConfiguratorInterface::class);

        if (empty($this->url)) {
            $this->url = Url::to('', true);
        }

        parent::init();
    }

    /**
     * @return bool
     */
    private function enableDefaultIcons()
    {
        return $this->_configurator instanceof Configurator &&
            $this->_configurator->enableDefaultIcons;
    }

    /**
     * @return bool
     * @since 1.4.1
     */
    private function isSeoEnabled()
    {
        return $this->_configurator instanceof Configurator &&
            $this->_configurator->enableSeoOptions;
    }

    /**
     * Creates driver object.
     * 
     * @param array $driverConfig
     * @return object
     */
    private function createDriver($driverConfig)
    {
        /* @var \ymaker\social\share\base\DriverAbstract $driver */
        $driver = Yii::createObject(ArrayHelper::merge([
            'class'       => $driverConfig['class'],
            'url'         => $this->url,
            'title'       => $this->title,
            'description' => $this->description,
            'imageUrl'    => $this->imageUrl
        ], isset($driverConfig['config']) ? $driverConfig['config'] : []));

        if (key_exists($driverConfig['class'], $this->driverProperties)) {
            foreach ($this->driverProperties[$driverConfig['class']] as $property => $value) {
                if ($driver->hasProperty($property)) {
                    $driver->$property = $value;
                }
            }
        }

        return $driver;
    }

    /**
     * Build label for driver.
     * 
     * @param array $driverConfig
     * @param string $defaultLabel
     * @return string
     */
    protected function buildLabel($driverConfig, $defaultLabel)
    {
        return $this->enableDefaultIcons()
            ? Html::tag('i', '', ['class' => $this->_configurator->getIconSelector($driverConfig['class'])])
            : (isset($driverConfig['label']) ? $driverConfig['label'] : $defaultLabel);
    }

    /**
     * Combine global and custom HTML options.
     *
     * @param array $driverConfig
     * @return array
     */
    private function combineOptions($driverConfig)
    {
        $options = isset($driverConfig['options']) ? $driverConfig['options'] : [];

        $globalOptions = $this->_configurator->getOptions();
        if (empty($globalOptions)) {
            return $options;
        }

        if (isset($options['class'])) {
            Html::addCssClass($globalOptions, $options['class']);
            unset($options['class']);
        }

        return ArrayHelper::merge($globalOptions, $options);
    }

    /**
     * Returns array with share links in <a> HTML tag.
     *
     * @return array
     */
    protected function processSocialNetworks()
    {
        $socialNetworks = $this->_configurator->getSocialNetworks();
        $shareLinks = [];

        foreach ($socialNetworks as $key => $socialNetwork) {
            if (isset($socialNetwork['class'])) {
                /* @var \ymaker\social\share\base\DriverAbstract $driver */
                $driver = $this->createDriver($socialNetwork);

                $linkOptions = $this->combineOptions($socialNetworks);
                $linkOptions['href'] = $driver->getLink();
                $shareLinks[] = Html::tag('a', $this->buildLabel($socialNetwork, Inflector::camel2words($key)), $linkOptions);
            }
        }

        return $shareLinks;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $links = $this->processSocialNetworks();

        if ($this->enableDefaultIcons()) {
            $this->getView()->registerAssetBundle(SocialIconsAsset::class);
        }

        $isSeoEnabled = $this->isSeoEnabled();
        if ($isSeoEnabled) {
            echo '<!--noindex-->';
        }

        echo Html::beginTag($this->wrapperTag, $this->wrapperOptions);
        foreach ($links as $link) {
            echo ($this->linkWrapperTag !== false) ? Html::tag($this->linkWrapperTag, $link, $this->linkWrapperOptions) : $link;
        }
        echo Html::endTag($this->wrapperTag);

        if ($isSeoEnabled) {
            echo '<!--/noindex-->';
        }
    }
}
