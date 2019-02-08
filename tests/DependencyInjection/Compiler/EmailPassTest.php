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
use TBoileau\Bundle\EmailBundle\Mailer\MailerInterface;
use TBoileau\Bundle\EmailBundle\Tests\Email\FooEmail;
use TBoileau\Bundle\EmailBundle\Tests\Handler\FooHandler;

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

        $handlerDefinition = new Definition(FooEmail::class);
        $handlerDefinition->setTags(["t_boileau.email" => []]);

        $this->container->setDefinition(FooHandler::class, $handlerDefinition);

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
        $this->assertInstanceOf(MailerInterface::class, $this->container->get(FooEmail::class));
    }
}
