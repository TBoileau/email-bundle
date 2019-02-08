<?php

/*
 * (c) Thomas Boileau <t-boileau@email.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TBoileau\Bundle\EmailBundle\Tests\Email;

use Symfony\Component\OptionsResolver\OptionsResolver;
use TBoileau\Bundle\EmailBundle\Builder\MessageBuilderInterface;
use TBoileau\Bundle\EmailBundle\Email\AbstractEmail;

/**
 * Class FooEmail
 *
 * @package TBoileau\Bundle\EmailBundle\Tests\Email
 * @author Thomas Boileau <t-boileau@email.com>
 */
class FooEmail extends AbstractEmail
{
    public function buildMessage(MessageBuilderInterface $builder, array $options): void
    {
        $builder
            ->setSubject("subject")
            ->setFrom("t-boileau@email.com")
            ->setTo("t-boileau@email.com")
            ->setBody("Hello ".$options["name"])
        ;
    }

    public function configure(OptionsResolver $resolver): void
    {
        $resolver->setRequired("name");
    }
}
