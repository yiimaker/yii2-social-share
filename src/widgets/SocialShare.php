<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\widgets;

use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
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
     * Creates driver object.
     * 
     * @param string $className
     * @param array $config
     * @return object
     */
    private function createDriver($className, array $config)
    {
        return Yii::createObject(ArrayHelper::merge([
            'class'       => $className,
            'url'         => $this->url,
            'title'       => $this->title,
            'description' => $this->description,
            'imageUrl'    => $this->imageUrl
        ], $config));
    }

    /**
     * Build label for driver.
     * 
     * @param string $driverName
     * @param string $label
     * @return string
     */
    protected function buildLabel($driverName, $label)
    {
        $iconSelector = $this->_configurator->getIconSelector($driverName);
        return $this->enableDefaultIcons()
            ? Html::tag('i', '', ['class' => $iconSelector])
            : $label;
    }

    /**
     * Combine global and custom HTML options.
     *
     * @param array $options
     * @return array
     */
    private function combineOptions($options)
    {
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
                $label = $this->buildLabel(
                    $socialNetwork['class'],
                    isset($socialNetwork['label']) ? $socialNetwork['label'] : $key
                );

                $options = $this->combineOptions(
                    isset($socialNetwork['options']) ? $socialNetwork['options'] : []
                );

                /* @var \ymaker\social\share\base\Driver $driver */
                $driver = $this->createDriver(
                    $socialNetwork['class'],
                    isset($socialNetwork['config']) ? $socialNetwork['config'] : []
                );

                $shareLinks[] = Html::a($label, $driver->getLink(), $options);
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

        echo Html::beginTag($this->wrapperTag, $this->wrapperOptions);
        foreach ($links as $link) {
            echo ($this->linkWrapperTag !== false)
                ? Html::tag($this->linkWrapperTag, $link, $this->linkWrapperOptions)
                : $link;
        }
        echo Html::endTag($this->wrapperTag);
    }
}
