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
 * Class AbstractEmail
 *
 * @package TBoileau\Bundle\EmailBundle\Email
 * @author Thomas Boileau <t-boileau@email.com>
 */
abstract class AbstractEmail implements EmailInterface
{
    /**
     * @inheritdoc
     */
    public function buildMessage(MessageBuilderInterface $builder, array $options): void
    {

    }

    /**
     * @inheritdoc
     */
    public function configure(OptionsResolver $resolver): void
    {

    }
}
