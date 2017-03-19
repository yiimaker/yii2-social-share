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
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
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
    public $wrapperTag = 'div';
    /**
     * @var array HTML options for wrapper tag
     */
    public $wrapperOptions = ['class' => 'social-share'];

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
     * @return array Returns array with share links in <a> HTML tag
     */
    protected function processSocialNetworks()
    {
        $socialNetworks = $this->_configurator->getSocialNetworks();
        $shareLinks = [];

        foreach ($socialNetworks as $key => $socialNetwork) {
            if (isset($socialNetwork['class'])) {
                /* @var \ymaker\social\share\base\Driver $object */
                $object = Yii::createObject([
                    'class'       => $socialNetwork['class'],
                    'url'         => $this->url,
                    'title'       => $this->title,
                    'description' => $this->description,
                    'imageUrl'    => $this->imageUrl
                ]);
                $link = $object->getLink();
                $label = isset($socialNetwork['label']) ? $socialNetwork['label'] : $key;
                $options = isset($socialNetwork['options']) ? $socialNetwork['options'] : [];
                $options = ArrayHelper::merge($this->_configurator->getOptions(), $options);

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

        echo Html::beginTag($this->wrapperTag, $this->wrapperOptions);
        foreach ($links as $link) {
            echo $link;
        }
        echo Html::endTag($this->wrapperTag);
    }
}
