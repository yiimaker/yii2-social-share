<?php

/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2019 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\unit\configurators;

use Codeception\Test\Unit;
use ymaker\social\share\configurators\Configurator;
use ymaker\social\share\configurators\ConfiguratorInterface;
use ymaker\social\share\configurators\IconsConfigInterface;
use ymaker\social\share\configurators\SeoConfigInterface;
use ymaker\social\share\drivers\Telegram;

/**
 * Test case for default configurator.
 *
 * @property \UnitTester $tester
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * @since 2.3
 */
class ConfiguratorTest extends Unit
{
    /**
     * @var Configurator
     */
    private $configurator;

    /**
     * {@inheritdoc}
     */
    protected function _before()
    {
        $this->configurator = new Configurator();
    }

    public function testInstanceOfConfigurator()
    {
        static::assertInstanceOf(ConfiguratorInterface::class, $this->configurator);
    }

    public function testDefaultSeoOptions()
    {
        static::assertInstanceOf(SeoConfigInterface::class, $this->configurator);
        static::assertTrue($this->configurator->isSeoEnabled());

        $options = $this->configurator->getOptions();

        static::assertArrayHasKey(
            'target',
            $options,
            'By default configurator should add "target=_blank" SEO option'
        );
        static::assertArrayHasKey(
            'rel',
            $options,
            'By default configurator should add "rel=noopener" SEO option'
        );
        static::assertEquals(
            '_blank',
            $options['target'],
            'By default configurator should add "target=_blank" SEO option'
        );
        static::assertEquals(
            'noopener',
            $options['rel'],
            'By default configurator should add "rel=noopener" SEO option'
        );

        $this->configurator->enableSeoOptions = false;
        $options = $this->configurator->getOptions();

        static::assertArrayNotHasKey('target', $options);
        static::assertArrayNotHasKey('rel', $options);
    }

    public function testIconsConfig()
    {
        static::assertInstanceOf(IconsConfigInterface::class, $this->configurator);
        static::assertFalse($this->configurator->isIconsEnabled());
        static::assertTrue($this->configurator->isDefaultAssetEnabled());

        $this->configurator = new Configurator(['enableIcons' => true]);

        static::assertTrue($this->configurator->isIconsEnabled());
        static::assertEquals(
            Configurator::DEFAULT_ICONS_MAP,
            $this->configurator->icons,
            'If "enableIcons" option is enabled, configurator should have default icons map'
        );
    }

    public function testDeprecatedIconsConfig()
    {
        static::assertFalse($this->configurator->isIconsEnabled());

        $this->configurator = new Configurator(['enableDefaultIcons' => true]);

        static::assertTrue($this->configurator->isIconsEnabled());
        static::assertEquals(
            Configurator::DEFAULT_ICONS_MAP,
            $this->configurator->icons,
            'If "enableDefaultIcons" option is enabled, configurator should have default icons map'
        );
    }

    public function testGetIconSelector()
    {
        static::assertEquals('', $this->configurator->getIconSelector('test'));

        $this->configurator = new Configurator(['enableIcons' => true]);

        static::assertEquals(
            Configurator::DEFAULT_ICONS_MAP[Telegram::class],
            $this->configurator->getIconSelector(Telegram::class)
        );
    }
}
