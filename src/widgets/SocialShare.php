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
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

use ymaker\social\share\assets\SocialIconsAsset;

/**
 * Widget for rendering the share links
 *
 * @property string $configuratorId
 * @property string $url
 * @property string $title
 * @property string $description
 * @property string $imageUrl
 * @property string $wrapperTag
 * @property array $wrapperOptions
 * @property string $linkWrapperTag
 * @property array $linkWrapperOptions
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class SocialShare extends Widget
{
    /**
     * @var string ID of configurator component
     */
    public $configuratorId;
    /**
     * @var string Absolute URL to the page
     */
    public $url = '';
    /**
     * @var string Title for share
     */
    public $title = '';
    /**
     * @var string Description for share
     */
    public $description = '';
    /**
     * @var string Absolute URL to the image for share
     */
    public $imageUrl = '';
    /**
     * @var string Name of the wrapper tag
     */
    public $wrapperTag = 'ul';
    /**
     * @var array HTML options for wrapper tag
     */
    public $wrapperOptions = ['class' => 'social-share'];
    /**
     * @var bool|string Name of the wrapper tag for link
     * Set `false` value if you don't want using wrapper for link
     */
    public $linkWrapperTag = 'li';
    /**
     * @var array HTML options for link wrapper tag
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
        if (!is_string($this->configuratorId)) {
            throw new InvalidConfigException('You should to set the configurator ID');
        }
        elseif (!Yii::$app->has($this->configuratorId)) {
            throw new Exception("The configurator with ID '$this->configuratorId' not found in app");
        }

        $this->_configurator = Yii::$app->get($this->configuratorId);

        if (empty($this->url)) {
            $this->url = Url::to('', true);
        }
    }

    /**
     * Generates icon tag
     * @param string $class
     * @return string
     */
    protected function generateIcon($class)
    {
        return Html::tag('i', '', ['class' => $class]);
    }

    /**
     * @return array Returns array with share links in <a> HTML tag
     */
    protected function processSocialNetworks()
    {
        $socialNetworks = $this->_configurator->getSocialNetworks();
        $shareLinks = [];

        foreach ($socialNetworks as $key => $socialNetwork) {
            if (isset($socialNetwork['class'])) {
                $config = isset($socialNetwork['config'])
                    ? $socialNetwork['config']
                    : [];

                /* @var \ymaker\social\share\base\Driver $object */
                $object = Yii::createObject(ArrayHelper::merge([
                    'class'       => $socialNetwork['class'],
                    'url'         => $this->url,
                    'title'       => $this->title,
                    'description' => $this->description,
                    'imageUrl'    => $this->imageUrl
                ], $config));

                $link = $object->getLink();

                $label = '';
                if ($this->_configurator->enableDefaultIcons) {
                    $driverName = get_class($object);
                    $label = $this->generateIcon($this->_configurator->getIconSelector($driverName));
                }
                else {
                    $label = isset($socialNetwork['label']) ? $socialNetwork['label'] : $key;
                }

                $options = $this->_configurator->getOptions();
                if (isset($socialNetwork['options']['class'])) {
                    Html::addCssClass($options, $socialNetwork['options']['class']);
                    unset($socialNetwork['options']['class']);
                }
                if (isset($socialNetwork['options'])) {
                    $options = ArrayHelper::merge($options, $socialNetwork['options']);
                }

                $shareLinks[] = Html::a($label, $link, $options);
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

        if ($this->_configurator->enableDefaultIcons) {
            $this->getView()->registerAssetBundle(SocialIconsAsset::class);
        }

        echo Html::beginTag($this->wrapperTag, $this->wrapperOptions);
        foreach ($links as $link) {
            echo ($this->linkWrapperOptions !== false)
                ? Html::tag($this->linkWrapperTag, $link, $this->linkWrapperOptions)
                : $link;
        }
        echo Html::endTag($this->wrapperTag);
    }
}
