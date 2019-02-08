<?php

/*
 * (c) Thomas Boileau <t-boileau@email.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TBoileau\Bundle\EmailBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\ServiceLocatorTagPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class EmailPass
 *
 * @package TBoileau\Bundle\EmailBundle\DependencyInjection\Compiler
 * @author Thomas Boileau <t-boileau@email.com>
 */
class EmailPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition("t_boileau.email.mailer_factory");

        $definition->addMethodCall('setServiceLocator', [$this->processHandler($container)]);
    }

    /**
     * @param ContainerBuilder $container
     * @return Reference
     */
    private function processHandler(ContainerBuilder $container): Reference
    {
        /** @var Reference[] $servicesMap */
        $servicesMap =  [];

        $taggedServices = $container->findTaggedServiceIds("t_boileau.email", true);

        /**
         * @var string $serviceId
         * @var array $taggedServiceId
         */
        foreach ($taggedServices as $serviceId => $taggedServiceId) {
            $servicesMap[$container->getDefinition($serviceId)->getClass()] = new Reference($serviceId);
        }

        return ServiceLocatorTagPass::register($container, $servicesMap);
    }
}
