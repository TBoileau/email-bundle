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
 * Class MailerFactory
 *
 * Creates a new mailer
 *
 * @package TBoileau\Bundle\EmailBundle\Factory
 * @author Thomas Boileau <t-boileau@email.com>
 */
class MailerFactory implements MailerFactoryInterface
{
    /**
     * @var ServiceLocator
     */
    private $serviceLocator;

    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * MailerFactory constructor.
     *
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * {@inheritdoc}
     */
    public function setServiceLocator(ServiceLocator $serviceLocator): void
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * {@inheritdoc}
     */
    public function create(string $email): MailerInterface
    {
        $this->mailer->setEmail($this->serviceLocator->get($email));

        return $this->mailer;
    }
}
