<?php

/*
 * (c) Thomas Boileau <t-boileau@email.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TBoileau\Bundle\FormHandlerBundle\Tests\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use TBoileau\Bundle\FormHandlerBundle\Config\HandlerConfig;
use TBoileau\Bundle\FormHandlerBundle\Config\HandlerConfigInterface;
use TBoileau\Bundle\FormHandlerBundle\DependencyInjection\TBoileauFormHandlerExtension;
use TBoileau\Bundle\FormHandlerBundle\Factory\ManagerFactoryInterface;
use TBoileau\Bundle\FormHandlerBundle\Manager\HandlerManager;
use TBoileau\Bundle\FormHandlerBundle\Manager\HandlerManagerInterface;

/**
 * Class TBoileauFormHandlerExtensionTest
 *
 * @package TBoileau\Bundle\FormHandlerBundle\Tests\DependencyInjection
 * @author Thomas Boileau <t-boileau@email.com>
 */
class TBoileauFormHandlerExtensionTest extends TestCase
{
    /**
     * @var TBoileauFormHandlerExtension|null
     */
    private $extension;

    /**
     * @var ContainerBuilder|null
     */
    private $container;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->extension = new TBoileauFormHandlerExtension();
        $this->container = new ContainerBuilder(new ParameterBag());
        $this->extension->load([], $this->container);
    }

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        $this->extension = null;
        $this->container = null;
    }

    /**
     * @dataProvider provideServiceId
     * @param string $serviceId
     * @param string $aliasId
     * @throws \Exception
     */
    public function testExistingDefinitions(string $serviceId, string $aliasId)
    {
        $this->assertTrue($this->container->hasDefinition($serviceId));
        $this->assertTrue($this->container->hasAlias($aliasId));
    }

    /**
     * @return \Generator
     */
    public function provideServiceId(): \Generator
    {
        yield [
            "t_boileau.form_handler.manager_factory",
            ManagerFactoryInterface::class
        ];

        yield [
            HandlerManager::class,
            HandlerManagerInterface::class
        ];

        yield [
            HandlerConfig::class,
            HandlerConfigInterface::class
        ];
    }
}
