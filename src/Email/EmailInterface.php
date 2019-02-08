<?php

/*
 * (c) Thomas Boileau <t-boileau@email.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TBoileau\Bundle\EmailBundle\Email;

use Symfony\Component\OptionsResolver\OptionsResolver;
use TBoileau\Bundle\EmailBundle\Builder\MessageBuilderInterface;

/**
 * Interface EmailInterface
 *
 * @package TBoileau\Bundle\EmailBundle\Email
 * @author Thomas Boileau <t-boileau@email.com>
 */
interface EmailInterface
{
    /**
     * Build the email message
     *
     * @param MessageBuilderInterface $builder
     * @param array $options
     */
    public function buildMessage(MessageBuilderInterface $builder, array $options): void;

    /**
     * Configure the email, pass options like data
     *
     * @param OptionsResolver $resolver
     */
    public function configure(OptionsResolver $resolver): void;
}
