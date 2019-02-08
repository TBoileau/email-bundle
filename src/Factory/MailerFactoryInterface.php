<?php

/*
 * (c) Thomas Boileau <t-boileau@email.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TBoileau\Bundle\EmailBundle\Factory;

use Symfony\Component\DependencyInjection\ServiceLocator;
use TBoileau\Bundle\EmailBundle\Mailer\MailerInterface;

/**
 * Interface MailerFactoryInterface
 *
 * @package TBoileau\Bundle\EmailBundle\Factory
 * @author Thomas Boileau <t-boileau@email.com>
 */
interface MailerFactoryInterface
{
    /**
     * Instantiates a new mailer
     *
     * @param string $email
     * @return MailerInterface
     */
    public function create(string $email): MailerInterface;

    /**
     * Set service locator to retrieve the mailer service
     *
     * @param ServiceLocator $serviceLocator
     */
    public function setServiceLocator(ServiceLocator $serviceLocator): void;
}
