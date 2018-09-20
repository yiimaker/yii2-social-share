<?php
/**
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2018 Yii Maker
 * @license BSD 3-Clause License
 */

namespace ymaker\social\share\tests\unit\configurators;

use Codeception\Test\Unit;
use ymaker\social\share\configurators\Configurator;
use ymaker\social\share\configurators\IconsConfigInterface;
use ymaker\social\share\drivers\Telegram;

/**
 * Test case for default configurator.
 *
 * @property-read \UnitTester $tester
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

    public function testDefaultSeoOptions()
    {
        $options = $this->configurator->getOptions();

        self::assertArrayHasKey(
            'target',
            $options,
            'By default configurator should add "target=_blank" SEO option'
        );
        self::assertArrayHasKey(
            'rel',
            $options,
            'By default configurator should add "rel=noopener" SEO option'
        );
        self::assertEquals(
            '_blank',
            $options['target'],
            'By default configurator should add "target=_blank" SEO option'
        );
        self::assertEquals(
            'noopener',
            $options['rel'],
            'By default configurator should add "rel=noopener" SEO option'
        );

        $this->configurator->enableSeoOptions = false;
        $options = $this->configurator->getOptions();

        self::assertArrayNotHasKey('target', $options);
        self::assertArrayNotHasKey('rel', $options);
    }

    public function testIconsConfig()
    {
        self::assertInstanceOf(IconsConfigInterface::class, $this->configurator);
        self::assertFalse($this->configurator->isIconsEnabled());
        self::assertTrue($this->configurator->isDefaultAssetEnabled());

        $this->configurator = new Configurator(['enableIcons' => true]);

        self::assertTrue($this->configurator->isIconsEnabled());
        self::assertEquals(
            Configurator::DEFAULT_ICONS_MAP,
            $this->configurator->icons,
            'If "enableIcons" option is enabled, configurator should have default icons map'
        );
    }

    public function testDeprecatedIconsConfig()
    {
        self::assertFalse($this->configurator->isIconsEnabled());

        $this->configurator = new Configurator(['enableDefaultIcons' => true]);

        self::assertTrue($this->configurator->isIconsEnabled());
        self::assertEquals(
            Configurator::DEFAULT_ICONS_MAP,
            $this->configurator->icons,
            'If "enableDefaultIcons" option is enabled, configurator should have default icons map'
        );
    }

    public function testGetIconSelector()
    {
        self::assertEquals('', $this->configurator->getIconSelector('test'));

        $this->configurator = new Configurator(['enableIcons' => true]);

        self::assertEquals(
            Configurator::DEFAULT_ICONS_MAP[Telegram::class],
            $this->configurator->getIconSelector(Telegram::class)
        );
    }
}
