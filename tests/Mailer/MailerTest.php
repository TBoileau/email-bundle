<?php

/*
 * (c) Thomas Boileau <t-boileau@email.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TBoileau\Bundle\FormHandlerBundle\Tests\Manager;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use TBoileau\Bundle\EmailBundle\Builder\MessageBuilder;
use TBoileau\Bundle\EmailBundle\Builder\MessageBuilderInterface;
use TBoileau\Bundle\EmailBundle\Email\EmailInterface;
use TBoileau\Bundle\EmailBundle\Mailer\Mailer;
use TBoileau\Bundle\EmailBundle\Mailer\MailerInterface;
use TBoileau\Bundle\EmailBundle\Tests\Email\FooEmail;

/**
 * Class MailerTest
 *
 * @package TBoileau\Bundle\FormHandlerBundle\Tests\Manager
 * @author Thomas Boileau <t-boileau@email.com>
 */
class MailerTest extends TestCase
{
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var MessageBuilderInterface
     */
    private $builder;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $mailer = $this->createMock(\Swift_Mailer::class);

        $this->builder = new MessageBuilder();

        $email = new FooEmail();

        $this->mailer = new Mailer($mailer, $this->builder);
        $this->mailer->setEmail($email);
    }

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        $this->mailer = null;
    }

    public function testSuccessfulEmailSent()
    {
        $this->assertInstanceOf(EmailInterface::class, $this->mailer->getEmail());
        $this->assertEquals($this->builder, $this->mailer->getBuilder());

        $this->mailer->send([
            "name" => "name"
        ]);


        $this->assertEquals("subject", $this->builder->getSubject());
        $this->assertArrayHasKey("t-boileau@email.com", $this->builder->getFrom());
        $this->assertArrayHasKey("t-boileau@email.com", $this->builder->getTo());
        $this->assertEquals("Hello name", $this->builder->getBody());
    }

}
