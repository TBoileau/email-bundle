<?php

/*
 * (c) Thomas Boileau <t-boileau@email.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TBoileau\Bundle\EmailBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use TBoileau\Bundle\EmailBundle\DependencyInjection\Compiler\EmailPass;

/**
 * Class TBoileauEmailBundle
 *
 * @package TBoileau\Bundle\EmailBundle
 * @author Thomas Boileau <t-boileau@email.com>
 * @codeCoverageIgnore
 */
class TBoileauEmailBundle extends Bundle
{
    /**
     * @inheritdoc
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new EmailPass());
    }
}
