<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2018 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\widgets;

use Yii;
use yii\base\Widget;
use yii\db\Connection;
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
     * @var string|array|ConfiguratorInterface
     */
    public $configurator;
    /**
     * Absolute URL to the page.
     *
     * @var string
     */
    public $url = '';
    /**
     * Title for share.
     *
     * @var string
     */
    public $title = '';
    /**
     * Description for share.
     *
     * @var string
     */
    public $description = '';
    /**
     * Absolute URL to the image for share.
     *
     * @var string
     */
    public $imageUrl = '';
    /**
     * Special properties for specific driver.
     *
     * @var array
     *
     * @since 1.4.0
     */
    public $driverProperties = [];
    /**
     * HTML options for links container tag.
     * If you won't to use it - set `tag` option to `false`.
     *
     * @var array
     */
    public $containerOptions = ['tag' => 'ul', 'class' => 'social-share'];
    /**
     * HTML options for link container tag.
     * If you won't to use it - set `tag` option to `false`.
     *
     * @var array
     */
    public $linkContainerOptions = ['tag' => 'li'];


    /**
     * Initialize the widget: gets configurator instance,
     * sets [[url]] property if empty. Triggers [[EVENT_INIT]] event after initialization.
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        $this->configurator = Instance::ensure($this->configurator, ConfiguratorInterface::class);

        if (empty($this->url)) {
            $this->url = Url::to('', true);
        }

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->enableDefaultIcons()) {
            $this->getView()->registerAssetBundle(SocialIconsAsset::class);
        }

        if ($this->isSeoEnabled()) {
            echo '<!--noindex-->';
        }

        $containerTag = ArrayHelper::remove($this->containerOptions, 'tag', false);
        if ($containerTag) {
            echo Html::beginTag($containerTag, $this->containerOptions);
        }

        $wrapTag = ArrayHelper::remove($this->linkContainerOptions, 'tag', false);
        foreach ($this->getLinkList() as $link) {
            echo $wrapTag ? Html::tag($wrapTag, $link, $this->linkContainerOptions) : $link;
        }

        if ($containerTag) {
            echo Html::endTag($containerTag);
        }

        if ($this->isSeoEnabled()) {
            echo '<!--/noindex-->';
        }
    }

    /**
     * @return bool
     */
    final protected function enableDefaultIcons()
    {
        return $this->configurator instanceof Configurator &&
            $this->configurator->enableDefaultIcons;
    }

    /**
     * @return bool
     *
     * @since 1.4.1
     */
    final protected function isSeoEnabled()
    {
        return $this->configurator instanceof Configurator &&
            $this->configurator->enableSeoOptions;
    }

    /**
     * @return bool
     *
     * @since 2.1
     */
    final protected function registerMetaTags()
    {
        return $this->configurator instanceof Configurator &&
            $this->configurator->registerMetaTags;
    }

    /**
     * Build label for driver.
     *
     * @param array     $driverConfig
     * @param string    $defaultLabel
     *
     * @return string
     */
    protected function getLinkLabel($driverConfig, $defaultLabel)
    {
        return $this->enableDefaultIcons()
            ? Html::tag('i', '', ['class' => $this->configurator->getIconSelector($driverConfig['class'])])
            : (isset($driverConfig['label']) ? $driverConfig['label'] : $defaultLabel);
    }

    /**
     * Creates driver instance.
     *
     * @param array $config Configuration for driver.
     *
     * @return \ymaker\social\share\base\AbstractDriver
     *
     * @throws \yii\base\InvalidConfigException
     */
    private function createDriver($config)
    {
        $fullConfig = ArrayHelper::merge(
            [
                'class' => $config['class'],
                'url' => $this->url,
                'title' => $this->title,
                'description' => $this->description,
                'imageUrl' => $this->imageUrl,
                'registerMetaTags' => $this->registerMetaTags(),
            ],
            isset($config['config']) ? $config['config'] : [],
            isset($this->driverProperties[$config['class']]) ? $this->driverProperties[$config['class']] : []
        );

        return Yii::createObject($fullConfig);
    }

    /**
     * Combine global and custom HTML options.
     *
     * @param array $driverConfig
     *
     * @return array
     */
    private function combineOptions($driverConfig)
    {
        $options = isset($driverConfig['options']) ? $driverConfig['options'] : [];

        $globalOptions = $this->configurator->getOptions();
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
     *
     * @throws \yii\base\InvalidConfigException
     */
    private function getLinkList()
    {
        $linkList = [];

        foreach ($this->configurator->getSocialNetworks() as $key => $socialNetwork) {
            if (isset($socialNetwork['class'])) {
                $linkOptions = $this->combineOptions($socialNetwork);
                $linkOptions['href'] = $this->createDriver($socialNetwork)->getLink();
                $linkList[] = Html::tag('a', $this->getLinkLabel($socialNetwork, Inflector::camel2words($key)), $linkOptions);
            }
        }

        return $linkList;
    }
}
