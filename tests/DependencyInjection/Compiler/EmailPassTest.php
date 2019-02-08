<?php

/*
 * (c) Thomas Boileau <t-boileau@email.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TBoileau\Bundle\EmailBundle\Tests\DependencyInjection\Compiler;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use TBoileau\Bundle\EmailBundle\DependencyInjection\Compiler\EmailPass;
use TBoileau\Bundle\EmailBundle\DependencyInjection\TBoileauEmailExtension;
use TBoileau\Bundle\EmailBundle\Email\EmailInterface;
use TBoileau\Bundle\EmailBundle\Tests\Email\FooEmail;

/**
 * Class EmailPassTest
 *
 * @package TBoileau\Bundle\EmailBundle\Tests\DependencyInjection\Compiler
 * @author Thomas Boileau <t-boileau@email.com>
 */
class EmailPassTest extends TestCase
{
    /**
     * @var ContainerBuilder|null
     */
    private $container;

    /**
     * @var EmailPass|null
     */
    private $emailPass;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->emailPass = new EmailPass();

        $this->container = new ContainerBuilder(new ParameterBag());

        (new TBoileauEmailExtension())->load([], $this->container);

        $emailDefinition = new Definition(FooEmail::class);
        $emailDefinition->setTags(["t_boileau.email" => []]);

        $this->container->setDefinition(FooEmail::class, $emailDefinition);

        $this->emailPass->process($this->container);
    }

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        $this->emailPass = null;
        $this->container = null;
    }

    public function testSuccessfulProcess()
    {
        $this->assertInstanceOf(EmailInterface::class, $this->container->get(FooEmail::class));
    }
}
