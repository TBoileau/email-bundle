<?php

/*
 * (c) Thomas Boileau <t-boileau@email.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TBoileau\Bundle\EmailBundle\Tests\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use TBoileau\Bundle\EmailBundle\Builder\MessageBuilder;
use TBoileau\Bundle\EmailBundle\Builder\MessageBuilderInterface;
use TBoileau\Bundle\EmailBundle\DependencyInjection\TBoileauEmailExtension;
use TBoileau\Bundle\EmailBundle\Factory\MailerFactoryInterface;
use TBoileau\Bundle\EmailBundle\Mailer\Mailer;
use TBoileau\Bundle\EmailBundle\Mailer\MailerInterface;

/**
 * Class TBoileauEmailExtensionTest
 *
 * @package TBoileau\Bundle\EmailBundle\Tests\DependencyInjection
 * @author Thomas Boileau <t-boileau@email.com>
 */
class TBoileauEmailExtensionTest extends TestCase
{
    /**
     * @var TBoileauEmailExtension|null
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
        $this->extension = new TBoileauEmailExtension();
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
            "t_boileau.email.mailer_factory",
            MailerFactoryInterface::class
        ];

        yield [
            Mailer::class,
            MailerInterface::class
        ];

        yield [
            MessageBuilder::class,
            MessageBuilderInterface::class
        ];
    }
}
