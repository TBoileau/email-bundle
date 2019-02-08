<?php

/*
 * (c) Thomas Boileau <t-boileau@email.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TBoileau\Bundle\EmailBundle\Mailer;

use TBoileau\Bundle\EmailBundle\Builder\MessageBuilderInterface;
use TBoileau\Bundle\EmailBundle\Email\EmailInterface;

/**
 * Interface MailerInterface
 *
 * @package TBoileau\Bundle\EmailBundle\Mailer
 * @author Thomas Boileau <t-boileau@email.com>
 */
interface MailerInterface
{
    /**
     * Send your email
     *
     * @param array $options
     */
    public function send(array $options = []): void;

    /**
     * Retrieve message builder
     *
     * @return MessageBuilderInterface
     */
    public function getBuilder(): MessageBuilderInterface;

    /**
     * @param EmailInterface $email
     */
    public function setEmail(EmailInterface $email): void;

    /**
     * Retrieve email
     *
     * @return EmailInterface
     */
    public function getEmail(): EmailInterface;
}
