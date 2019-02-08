<?php

/*
 * (c) Thomas Boileau <t-boileau@email.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TBoileau\Bundle\EmailBundle\Tests\Factory;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\DependencyInjection\ServiceLocator;
use TBoileau\Bundle\EmailBundle\Factory\MailerFactory;
use TBoileau\Bundle\EmailBundle\Factory\MailerFactoryInterface;
use TBoileau\Bundle\EmailBundle\Email\EmailInterface;
use TBoileau\Bundle\EmailBundle\Mailer\MailerInterface;

/**
 * Class MailerFactoryTest
 *
 * @package TBoileau\Bundle\EmailBundle\Tests\Factory
 * @author Thomas Boileau <t-boileau@email.com>
 */
class MailerFactoryTest extends TestCase
{
    /**
     * @var MailerFactoryInterface
     */
    private $managerFactory;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $mailer = $this->createMock(MailerInterface::class);

        $email = $this->createMock(EmailInterface::class);

        $serviceLocator = $this->createMock(ServiceLocator::class);
        $serviceLocator->method("get")->willReturn($email);

        $this->managerFactory = new MailerFactory($mailer);

        $this->managerFactory->setServiceLocator($serviceLocator);
    }

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        $this->managerFactory = null;
    }


    public function testCreate()
    {
        $this->assertInstanceOf(MailerInterface::class, $this->managerFactory->create(""));
    }
}
