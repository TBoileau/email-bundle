<?php

/*
 * (c) Thomas Boileau <t-boileau@email.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TBoileau\Bundle\EmailBundle\Mailer;

use Symfony\Component\OptionsResolver\OptionsResolver;
use TBoileau\Bundle\EmailBundle\Builder\MessageBuilderInterface;
use TBoileau\Bundle\EmailBundle\Email\EmailInterface;

/**
 * Class Mailer
 *
 * @package TBoileau\Bundle\EmailBundle\Mailer
 * @author Thomas Boileau <t-boileau@email.com>
 */
class Mailer implements MailerInterface
{
    /**
     * @var \Swift_Mailer
     */
    private $swiftMailer;

    /**
     * @var MessageBuilderInterface
     */
    private $builder;

    /**
     * @var OptionsResolver
     */
    private $optionsResolver;

    /**
     * @var EmailInterface
     */
    private $email;

    /**
     * Mailer constructor.
     * @param \Swift_Mailer $swiftMailer
     * @param MessageBuilderInterface $builder
     * @param OptionsResolver $optionsResolver
     */
    public function __construct(\Swift_Mailer $swiftMailer, MessageBuilderInterface $builder)
    {
        $this->swiftMailer = $swiftMailer;
        $this->builder = $builder;
        $this->optionsResolver = new OptionsResolver();
    }

    /**
     * @inheritdoc
     */
    public function getBuilder(): MessageBuilderInterface
    {
        return $this->builder;
    }

    /**
     * @inheritdoc
     */
    public function setEmail(EmailInterface $email): void
    {
        $this->email = $email;
    }

    /**
     * @inheritdoc
     */
    public function getEmail(): EmailInterface
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function send(array $options = []): void
    {
        $this->email->configure($this->optionsResolver);

        $this->email->buildMessage($this->builder, $this->optionsResolver->resolve($options));

        $this->swiftMailer->send($this->builder->getMessage());
    }
}
